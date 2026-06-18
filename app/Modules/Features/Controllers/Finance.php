<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;

class Finance extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Affichage de la page
     */
    public function index()
    {
        $data['title'] = 'Gestion des finances';

        $data['types'] = $this->db
            ->table('type_finance')
            ->orderBy('DESCRIPTION_TYPE', 'ASC')
            ->get()
            ->getResult();

        return view('App\Modules\Features\Views\FinanceView', $data);
    }

    /**
     * Liste DataTable
     */
    public function getList(): mixed
    {
        $var_search = !empty($_POST['search']['value'])
            ? $_POST['search']['value']
            : null;

        $var_search = str_replace("'", "\'", $var_search);

        $query_principal = "
            SELECT
                f.ID_FINANCE,
                f.TYPE_FINANCE_ID,
                f.MONTANT,
                f.ANNEE_DE_PRESSION,
                f.DATE_INSERTION,
                tf.DESCRIPTION_TYPE
            FROM finances f
            LEFT JOIN type_finance tf
                ON tf.TYPE_FINANCE_ID = f.TYPE_FINANCE_ID
            WHERE 1
        ";

        $group = "";
        $critaire = "";

        $limit = 'LIMIT 0,1000';

        if ($_POST['length'] != -1) {
            $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
        }

        $order_column = [
            'f.ID_FINANCE',
            'tf.DESCRIPTION_TYPE',
            'f.MONTANT',
            'f.ANNEE_DE_PRESSION',
            'f.DATE_INSERTION',
            'f.ID_FINANCE'
        ];

        if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

            $colIndex = $_POST['order'][0]['column'];

            $order_by = isset($order_column[$colIndex])
                ? ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir']
                : ' ORDER BY f.ID_FINANCE DESC';

        } else {

            $order_by = ' ORDER BY f.ID_FINANCE DESC';
        }

        $search = !empty($var_search)
            ? " AND (
                tf.DESCRIPTION_TYPE LIKE '%$var_search%'
                OR f.MONTANT LIKE '%$var_search%'
                OR f.ANNEE_DE_PRESSION LIKE '%$var_search%'
            )"
            : "";

        $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group . ' ' . $order_by . ' ' . $limit;

        $query_filter = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group;

        $fetch_data = $this->model->datatable($query_secondaire);

        $data = [];
        $i = $_POST['start'] + 1;

        foreach ($fetch_data as $row) {

            $sub = [];

            $sub[] = $i++;

            $sub[] = $row->DESCRIPTION_TYPE;

            $sub[] = number_format(
                $row->MONTANT,
                0,
                ',',
                ' '
            ) . ' BIF';

            $sub[] = $row->ANNEE_DE_PRESSION;

            $sub[] = date(
                'd/m/Y',
                strtotime($row->DATE_INSERTION)
            );

            $sub[] = '
            <div class="btn-group">
                <button type="button"
                        class="btn btn-primary dropdown-toggle"
                        data-toggle="dropdown">
                    <i class="fa fa-cogs"></i> Actions
                </button>

                <div class="dropdown-menu">

                    <a class="dropdown-item"
                       onclick="editFinance(' . $row->ID_FINANCE . ')">
                        <i class="fa fa-edit"></i> Modifier
                    </a>

                    <a class="dropdown-item text-danger"
                       onclick="deleteFinance(' . $row->ID_FINANCE . ')">
                        <i class="fa fa-trash"></i> Supprimer
                    </a>

                </div>
            </div>';

            $data[] = $sub;
        }

        return $this->response->setJSON([
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $this->model->all_data($query_principal),
            "recordsFiltered" => $this->model->all_data($query_filter),
            "data" => $data,
        ]);
    }

    /**
     * Ajouter / Modifier
     */
    public function save()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false
            ]);
        }

        $rules = [
            'TYPE_FINANCE_ID' => 'required',
            'MONTANT' => 'required|numeric',
            'ANNEE_DE_PRESSION' => 'required'
        ];

        if (!$this->validate($rules)) {

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erreur de validation',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $id = $this->request->getPost('ID_FINANCE');

        $data = [
            'TYPE_FINANCE_ID' => $this->request->getPost('TYPE_FINANCE_ID'),
            'MONTANT' => $this->request->getPost('MONTANT'),
            'ANNEE_DE_PRESSION' => $this->request->getPost('ANNEE_DE_PRESSION')
        ];

        $builder = $this->db->table('finances');

        if (!empty($id)) {

            $builder->where('ID_FINANCE', $id)
                    ->update($data);

            $message = 'Finance modifiée';

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');

            $builder->insert($data);

            $message = 'Finance ajoutée';
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * Récupérer une ligne
     */
    public function getOne($id)
    {
        $data = $this->db->table('finances')
            ->where('ID_FINANCE', $id)
            ->get()
            ->getRow();

        return $this->response->setJSON([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Supprimer
     */
    public function delete()
    {
        $id = $this->request->getPost('ID_FINANCE');

        $this->db->table('finances')
            ->where('ID_FINANCE', $id)
            ->delete();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Finance supprimée'
        ]);
    }

    /**
     * Nombre total
     */
    private function countAll()
    {
        return $this->db->table('finances')
            ->countAllResults();
    }

    /**
     * Nombre filtré
     */
    private function countFiltered($search)
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM finances f
            LEFT JOIN type_finance tf
                ON tf.TYPE_FINANCE_ID = f.TYPE_FINANCE_ID
            WHERE 1=1
            $search
        ";

        return $this->db->query($sql)
            ->getRow()
            ->total;
    }
}