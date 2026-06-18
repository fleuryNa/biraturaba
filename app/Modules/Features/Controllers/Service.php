<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;


class Service extends BaseController
{
       protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function index()
    {
        $data['title'] = 'Liste de caracteritique';

        return view('App\Modules\Features\Views\ServiceView', $data);
    }


public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    // =========================
    // TABLE SERVICE
    // =========================
    $query_principal = "SELECT * FROM service WHERE 1";

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
        'ID_SERVICE',
        'NOM',
        'DESCRIPTION',
        'ICONE',
        'ID_SERVICE'
    ];

    if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

        $colIndex = $_POST['order'][0]['column'];

        if (isset($order_column[$colIndex])) {
            $order_by = ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir'];
        } else {
            $order_by = ' ORDER BY ID_SERVICE DESC';
        }

    } else {
        $order_by = ' ORDER BY ID_SERVICE DESC';
    }

    // =========================
    // SEARCH
    // =========================
    $search = !empty($var_search)
        ? " AND (NOM LIKE '%$var_search%' OR DESCRIPTION LIKE '%$var_search%')"
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

        $icon = !empty($row->ICONE)
            ? '<img src="' . base_url('uploads/service/' . $row->ICONE) . '" width="50">'
            : '';


            $fullDescription = iconv('UTF-8', 'UTF-8//IGNORE', $row->DESCRIPTION);

        $shortDescription = mb_strlen($fullDescription, 'UTF-8') > 60
            ? mb_substr($fullDescription, 0, 60, 'UTF-8') . '...'
            : $fullDescription;


        $sub = [];
        $sub[] = $i++;
        $sub[] = $row->NOM;
         $sub[] = '<span data-toggle="tooltip"
                data-placement="top"
                title="' . htmlspecialchars($fullDescription, ENT_QUOTES, 'UTF-8') . '">'
        . htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8')
        . '</span>';
        $sub[] = $icon;

        $sub[] = '
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cogs"></i> Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="editService(' . $row->ID_SERVICE . ')">
                    <i class="fa fa-edit"></i> Modifier
                </a>
                <a class="dropdown-item" onclick="deleteService(' . $row->ID_SERVICE . ')">
                    <i class="fa fa-trash"></i> Supprimer
                </a>
            </div>
        </div>';

        $data[] = $sub;
    }

    // =========================
    // OUTPUT
    // =========================
    $output = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $this->model->all_data($query_principal),
        "recordsFiltered" => $this->model->all_data($query_filter),
        "data" => $data,
    ];

    return $this->response->setJSON($output);
}

public function save()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Requête non autorisée'
        ]);
    }

    // =========================
    // VALIDATION
    // =========================
    $rules = [
        'NOM' => 'required|min_length[3]',
        'DESCRIPTION' => 'permit_empty|min_length[3]'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_SERVICE');

    $db = \Config\Database::connect();
    $db->transStart();

    try {

        $icon = $this->request->getFile('ICONE');
        $fileName = null;

        // =========================
        // UPLOAD ICON
        // =========================
        if ($icon && $icon->isValid() && !$icon->hasMoved()) {

            if (!in_array($icon->getMimeType(), [
                'image/jpeg',
                'image/png',
                'image/jpg',
                'image/webp'
            ])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Format image invalide'
                ]);
            }

            $fileName = $icon->getRandomName();
            $icon->move('uploads/service', $fileName);
        }

        // =========================
        // DATA
        // =========================
        $data = [
            'NOM' => trim($this->request->getPost('NOM')),
            'DESCRIPTION' => trim($this->request->getPost('DESCRIPTION'))
        ];

        if ($fileName) {
            $data['ICONE'] = $fileName;
        }

        $builder = $db->table('service');

        // =========================
        // INSERT / UPDATE
        // =========================
        if (!empty($id)) {

            // supprimer ancien icon
            $old = $builder->where('ID_SERVICE', $id)->get()->getRow();

            if ($old && !empty($fileName) && !empty($old->ICONE)) {
                $oldPath = FCPATH . 'uploads/service/' . $old->ICONE;

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $builder->where('ID_SERVICE', $id)->update($data);
            $message = "Service modifié avec succès";

        } else {

            $builder->insert($data);
            $message = "Service ajouté avec succès";
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            throw new \Exception("Erreur transaction");
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => $message
        ]);

    } catch (\Exception $e) {

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur serveur',
            'debug' => $e->getMessage()
        ]);
    }
}
public function getOne($id)
{
    $data = $this->db->table('service')
        ->where('ID_SERVICE', $id)
        ->get()
        ->getRow();

    if (!$data) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Service introuvable'
        ]);
    }

    return $this->response->setJSON([
        'success' => true,
        'data' => $data
    ]);
}
    // Suppression
public function delete()
{
    $id = $this->request->getPost('ID_SERVICE');

    $service = $this->db->table('service')
        ->where('ID_SERVICE', $id)
        ->get()
        ->getRow();

    if (!$service) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Service introuvable'
        ]);
    }

    // =========================
    // SUPPRESSION ICONE
    // =========================
    if (!empty($service->ICONE)) {
        $path = FCPATH . 'uploads/service/' . $service->ICONE;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    // =========================
    // DELETE DB
    // =========================
    $this->db->table('service')
        ->where('ID_SERVICE', $id)
        ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Service supprimé avec succès'
    ]);
}

private function countAll()
{
    return $this->db->table('service')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM service
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}