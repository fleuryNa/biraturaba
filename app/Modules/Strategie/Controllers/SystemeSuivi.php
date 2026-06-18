<?php

namespace App\Modules\Strategie\Controllers;

use App\Controllers\BaseController;


class SystemeSuivi extends BaseController
{

 protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data['title'] = 'Liste des Strategies';

        return view('App\Modules\Strategie\Views\SystemeSuiviView', $data);
    }

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    // =========================
    // TABLE BLOGS
    // =========================
    $query_principal = "SELECT * FROM systeme_suivi WHERE 1";

    $group = "";
    $critaire = "";

    // LIMIT
    $limit = 'LIMIT 0,1000';
    if ($_POST['length'] != -1) {
        $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }

    // =========================
    // ORDER
    // =========================
    $order_column = [
    'ID',
    'IMAGE',
    'DESCRIPTION',
    'STATUT',
    'DATE_INSERTION',
    'ID'
];

    if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

        $colIndex = $_POST['order'][0]['column'];

        $order_by = isset($order_column[$colIndex])
            ? ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir']
            : ' ORDER BY ID DESC';

    } else {
        $order_by = ' ORDER BY ID DESC';
    }

    // =========================
    // SEARCH
    // =========================
  $search = !empty($var_search)
    ? " AND (
        DESCRIPTION LIKE '%$var_search%'
        OR STATUT LIKE '%$var_search%'
    )"
    : "";

    // =========================
    // QUERY FINAL
    // =========================
    $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group . ' ' . $order_by . ' ' . $limit;
    $query_filter     = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group;

    $fetch_data = $this->model->datatable($query_secondaire);

    $data = [];
    $i = $_POST['start'] + 1;

    // =========================
    // LOOP DATA
    // =========================
foreach ($fetch_data as $row) {

    $img = !empty($row->IMAGE)
        ? '<img src="' . base_url('uploads/systeme_suivi/' . $row->IMAGE) . '"
                width="60" height="60"
                style="object-fit:cover;border-radius:6px;">'
        : '<span class="text-muted">Aucune image</span>';

    $fullDescription = $row->DESCRIPTION ?? '';

    $shortDescription = mb_strlen($fullDescription, 'UTF-8') > 60
        ? mb_substr($fullDescription, 0, 60, 'UTF-8') . '...'
        : $fullDescription;

    $status = $row->STATUT == 1
        ? '<span class="badge badge-success">Actif</span>'
        : '<span class="badge badge-danger">Inactif</span>';

    $toggleStatus = $row->STATUT == 1
        ? '<a class="dropdown-item text-warning"
                onclick="changeStatus(' . $row->ID . ',0)">
                <i class="fa fa-ban"></i> Désactiver
           </a>'
        : '<a class="dropdown-item text-success"
                onclick="changeStatus(' . $row->ID . ',1)">
                <i class="fa fa-check"></i> Activer
           </a>';

    $sub = [];
    $sub[] = $i++;
    $sub[] = $img;

    $sub[] = '<span data-toggle="tooltip"
                title="' . htmlspecialchars($fullDescription, ENT_QUOTES, 'UTF-8') . '">'
                . htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8') .
            '</span>';

    $sub[] = $status;
    $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

    $sub[] = '
    <div class="btn-group">
        <button type="button"
                class="btn btn-primary dropdown-toggle"
                data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Actions
        </button>

        <div class="dropdown-menu">

            <a class="dropdown-item"
               onclick="editSuivi(' . $row->ID . ')">
                <i class="fa fa-edit"></i> Modifier
            </a>

            ' . $toggleStatus . '

            <a class="dropdown-item text-danger"
               onclick="deleteSuivi(' . $row->ID . ')">
                <i class="fa fa-trash"></i> Supprimer
            </a>

        </div>
    </div>';

    $data[] = $sub;
}   
    // =========================
    // OUTPUT
    // =========================
    return $this->response->setJSON([
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $this->model->all_data($query_principal),
        "recordsFiltered" => $this->model->all_data($query_filter),
        "data" => $data,
    ]);
}


public function save()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON(['success' => false]);
    }

    $rules = [
        'DESCRIPTION' => 'required|min_length[3]'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID');

    $db = \Config\Database::connect();
    $db->transBegin();

    try {

        $fileName = null;
        $img = $this->request->getFile('IMAGE');

        if ($img && $img->isValid() && !$img->hasMoved()) {

            $allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

            if (!in_array($img->getMimeType(), $allowed)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Image invalide'
                ]);
            }

            $fileName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/systeme_suivi', $fileName);
        }

        $data = [
            'DESCRIPTION' => $this->request->getPost('DESCRIPTION'),
            'STATUT'      => $this->request->getPost('STATUT')
        ];

        if ($fileName) {
            $data['IMAGE'] = $fileName;
        }

        $builder = $db->table('systeme_suivi');

        if (!empty($id)) {

            $old = $builder->where('ID', $id)->get()->getRow();

            if ($old && $fileName && !empty($old->IMAGE)) {

                $path = FCPATH . 'uploads/systeme_suivi/' . $old->IMAGE;

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $builder->where('ID', $id)->update($data);

            $message = "Enregistrement modifié";

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');

            $builder->insert($data);

            $message = "Enregistrement ajouté";
        }

        $db->transCommit();

        return $this->response->setJSON([
            'success' => true,
            'message' => $message
        ]);

    } catch (\Throwable $e) {

        $db->transRollback();

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur serveur',
            'debug' => $e->getMessage()
        ]);
    }
}


public function getOne($id)
{
    $data = $this->db->table('systeme_suivi')
        ->where('ID', $id)
        ->get()
        ->getRow();

    return $this->response->setJSON([
        'success' => true,
        'data' => $data
    ]);
}

    // Suppression
public function delete()
{
    $id = $this->request->getPost('ID');

    $db = \Config\Database::connect();

    $old = $db->table('systeme_suivi')
        ->where('ID', $id)
        ->get()
        ->getRow();

    if ($old && !empty($old->IMAGE)) {
        $path = FCPATH.'uploads/systeme_suivi/'.$old->IMAGE;
        if (file_exists($path)) unlink($path);
    }

    $db->table('systeme_suivi')->where('ID', $id)->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Enregistrement supprimé'
    ]);
}

private function countAll()
{
    return $this->db->table('systeme_suivi')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) total
        FROM systeme_suivi
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}