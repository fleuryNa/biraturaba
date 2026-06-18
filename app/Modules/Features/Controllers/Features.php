<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;


class Features extends BaseController
{
     protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function index()
    {
        $data['title'] = 'Liste de caracteritique';

        return view('App\Modules\Features\Views\FeaturesView', $data);
    }

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    // =========================
    // TABLE FEATURES
    // =========================
    $query_principal = "SELECT * FROM features WHERE 1";

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
        'ID_FEATURE',
        'TITLE',
        'DESC_FEATURE',
        'ICON_FEATURE',
        'STATUS',
        'DATE_INSERTION',
        'ID_FEATURE'
    ];

    if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

        $colIndex = $_POST['order'][0]['column'];

        if (isset($order_column[$colIndex])) {
            $order_by = ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir'];
        } else {
            $order_by = ' ORDER BY ID_FEATURE DESC';
        }

    } else {
        $order_by = ' ORDER BY ID_FEATURE DESC';
    }

    // =========================
    // SEARCH (CORRIGÉ)
    // =========================
    $search = !empty($var_search)
        ? " AND (TITLE LIKE '%$var_search%' OR DESC_FEATURE LIKE '%$var_search%')"
        : "";

    // =========================
    // QUERY FINAL
    // =========================
    $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group . ' ' . $order_by . ' ' . $limit;
    $query_filter     = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group;

    $fetch_captage = $this->model->datatable($query_secondaire);

    $data = [];
    $i = $_POST['start'] + 1;

    // =========================
    // LOOP DATA
    // =========================
    foreach ($fetch_captage as $row) {

        $icon = !empty($row->ICON_FEATURE)
            ? '<img src="' . base_url('uploads/features/' . $row->ICON_FEATURE) . '" width="50">'
            : '';

        $status = ($row->STATUS == 1)
            ? '<span class="badge badge-success">Actif</span>'
            : '<span class="badge badge-danger">Inactif</span>';

        $sub = [];
        $sub[] = $i++;
        $sub[] = $row->TITLE;
        $sub[] = $row->DESC_FEATURE;
        $sub[] = $icon;
        $sub[] = $status;
        $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

        $sub[] = '
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cogs"></i> Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="editFeature(' . $row->ID_FEATURE . ')">
                    <i class="fa fa-edit"></i> Modifier
                </a>
                <a class="dropdown-item" onclick="deleteFeature(' . $row->ID_FEATURE . ')">
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
        'TITLE' => 'required|min_length[3]',
        'DESC_FEATURE' => 'permit_empty|min_length[3]'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_FEATURE');

    $db = \Config\Database::connect();
    $db->transStart();

    try {

        $icon = $this->request->getFile('ICON_FEATURE');
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
            $icon->move('uploads/features', $fileName);
        }

        // =========================
        // DATA
        // =========================
        $data = [
            'TITLE' => trim($this->request->getPost('TITLE')),
            'DESC_FEATURE' => trim($this->request->getPost('DESC_FEATURE')),
            'STATUS' => $this->request->getPost('STATUS')
        ];

        if ($fileName) {
            $data['ICON_FEATURE'] = $fileName;
        }

        $builder = $db->table('features');

        // =========================
        // INSERT / UPDATE
        // =========================
        if (!empty($id)) {

            // supprimer ancien icon si nouveau upload
            $old = $builder->where('ID_FEATURE', $id)->get()->getRow();

            if ($old && !empty($fileName) && !empty($old->ICON_FEATURE)) {
                $oldPath = FCPATH . 'uploads/features/' . $old->ICON_FEATURE;

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $builder->where('ID_FEATURE', $id)->update($data);
            $message = "Feature modifiée avec succès";

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');

            $builder->insert($data);
            $message = "Feature ajoutée avec succès";
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
    $data = $this->db->table('features')
        ->where('ID_FEATURE', $id)
        ->get()
        ->getRow();

    if (!$data) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Feature introuvable'
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
    $id = $this->request->getPost('ID_FEATURE');

    $feature = $this->db->table('features')
        ->where('ID_FEATURE', $id)
        ->get()
        ->getRow();

    if (!$feature) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Feature introuvable'
        ]);
    }

    // =========================
    // SUPPRESSION ICON
    // =========================
    if (!empty($feature->ICON_FEATURE)) {
        $path = FCPATH . 'uploads/features/' . $feature->ICON_FEATURE;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    // =========================
    // DELETE DB
    // =========================
    $this->db->table('features')
        ->where('ID_FEATURE', $id)
        ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Feature supprimée avec succès'
    ]);
}

private function countAll()
{
    return $this->db->table('features')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM features
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}