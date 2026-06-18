<?php

namespace App\Modules\Strategie\Controllers;

use App\Controllers\BaseController;


class Strategie extends BaseController
{

 protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data['title'] = 'Liste des Strategies';

        return view('App\Modules\Strategie\Views\StrategieView', $data);
    }

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    // =========================
    // TABLE BLOGS
    // =========================
    $query_principal = "SELECT * FROM objectifs WHERE 1";

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
    'ID_OBJECTIF',
    'TITRE',
    'IMAGE',
    'DESCRIPTION',
    'ORDRE_AFFICHAGE',
    'IS_ACTIF',
    'DATE_INSERTION',
    'ID_OBJECTIF'
];

    if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

        $colIndex = $_POST['order'][0]['column'];

        $order_by = isset($order_column[$colIndex])
            ? ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir']
            : ' ORDER BY ID_OBJECTIF DESC';

    } else {
        $order_by = ' ORDER BY ID_OBJECTIF DESC';
    }

    // =========================
    // SEARCH
    // =========================
    $search = !empty($var_search)
    ? " AND (
        TITRE LIKE '%$var_search%'
        OR DESCRIPTION LIKE '%$var_search%'
        OR ORDRE_AFFICHAGE LIKE '%$var_search%'
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
        ? '<img src="' . base_url('uploads/objectifs/' . $row->IMAGE) . '" width="60">'
        : '';

   $fullDescription = iconv('UTF-8', 'UTF-8//IGNORE', $row->DESCRIPTION);

        $shortDescription = mb_strlen($fullDescription, 'UTF-8') > 60
            ? mb_substr($fullDescription, 0, 60, 'UTF-8') . '...'
            : $fullDescription;

    $status = $row->IS_ACTIF == 1
        ? '<span class="badge badge-success">Actif</span>'
        : '<span class="badge badge-danger">Inactif</span>';

    $sub = [];
    $sub[] = $i++;
    $sub[] = $row->TITRE;
    $sub[] = $img;
      $sub[] = '<span data-toggle="tooltip"
                data-placement="top"
                title="' . htmlspecialchars($fullDescription, ENT_QUOTES, 'UTF-8') . '">'
        . htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8')
        . '</span>';
    $sub[] = $row->ORDRE_AFFICHAGE;
    $sub[] = $status;
    $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

    $sub[] = '
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="editObjectif(' . $row->ID_OBJECTIF . ')">
                <i class="fa fa-edit"></i> Modifier
            </a>
            <a class="dropdown-item" onclick="deleteObjectif(' . $row->ID_OBJECTIF . ')">
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
    'TITRE' => 'required|min_length[3]',
    'DESCRIPTION' => 'required|min_length[3]',
    'ORDRE_AFFICHAGE' => 'required|integer'
];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_OBJECTIF');
    $db = \Config\Database::connect();
    $db->transBegin();

    try {

        $fileName = null;
        $img = $this->request->getFile('IMAGE');

        if ($img && $img->isValid() && !$img->hasMoved()) {

            $allowed = ['image/jpeg','image/png','image/jpg','image/webp'];

            if (!in_array($img->getMimeType(), $allowed)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Image invalide'
                ]);
            }

            $fileName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/objectifs', $fileName);
        }

      $data = [
    'TITRE' => $this->request->getPost('TITRE'),
    'DESCRIPTION' => $this->request->getPost('DESCRIPTION'),
    'ORDRE_AFFICHAGE' => $this->request->getPost('ORDRE_AFFICHAGE'),
    'IS_ACTIF' => $this->request->getPost('IS_ACTIF')
];

        if ($fileName) {
            $data['IMAGE'] = $fileName;
        }

        $builder = $db->table('objectifs');

        if (!empty($id)) {

            $old = $builder->where('ID_OBJECTIF', $id)->get()->getRow();

            if ($old && $fileName && !empty($old->IMAGE)) {
                $path = FCPATH.'uploads/objectifs/'.$old->IMAGE;
                if (file_exists($path)) unlink($path);
            }

            $builder->where('ID_OBJECTIF', $id)->update($data);
            $message = "Objectif modifié";

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');
            $builder->insert($data);
            $message = "Objectif ajouté";
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
    $db = \Config\Database::connect();

    $data = $db->table('objectifs')
        ->where('ID_OBJECTIF', $id)
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
    $id = $this->request->getPost('ID_OBJECTIF');

    $db = \Config\Database::connect();

    $old = $db->table('objectifs')
        ->where('ID_OBJECTIF', $id)
        ->get()
        ->getRow();

    if ($old && !empty($old->IMAGE)) {
        $path = FCPATH.'uploads/objectifs/'.$old->IMAGE;
        if (file_exists($path)) unlink($path);
    }

    $db->table('objectifs')->where('ID_OBJECTIF', $id)->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Objectif supprimé'
    ]);
}

private function countAll()
{
    return $this->db->table('objectifs')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM objectifs
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}