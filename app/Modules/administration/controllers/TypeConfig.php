<?php

namespace App\Modules\administration\Controllers;

use App\Controllers\BaseController;


class TypeConfig extends BaseController
{

 protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data['title'] = 'Liste de type de groupes';

        return view('App\Modules\administration\Views\TypeConfigView', $data);
    }

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    // =========================
    // TABLE BLOGS
    // =========================
    $query_principal = "SELECT `ID_TYPE_GROUPE`, `DESC_GROUPE`,STATUT FROM `type_groupes` WHERE 1";

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
    'ID_TYPE_GROUPE',
    'DESC_GROUPE',
    'ID_TYPE_GROUPE'
];

    if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

        $colIndex = $_POST['order'][0]['column'];

        $order_by = isset($order_column[$colIndex])
            ? ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir']
            : ' ORDER BY ID_TYPE_GROUPE DESC';

    } else {
        $order_by = ' ORDER BY ID_TYPE_GROUPE DESC';
    }

    // =========================
    // SEARCH
    // =========================
    $search = !empty($var_search)
    ? " AND (
        DESC_GROUPE LIKE '%$var_search%'
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

   
   $fullDescription = iconv('UTF-8', 'UTF-8//IGNORE', $row->DESC_GROUPE);

        $shortDescription = mb_strlen($fullDescription, 'UTF-8') > 60
            ? mb_substr($fullDescription, 0, 60, 'UTF-8') . '...'
            : $fullDescription;

     // STATUS
    $status = $row->STATUT == 1
        ? '<span class="badge bg-success"><i class="fa fa-check"></i> Actif</span>'
        : '<span class="badge bg-danger"><i class="fa fa-times"></i> Inactif</span>';

    // ACTION ACTIVER / DESACTIVER
    $toggleStatus = $row->STATUT == 1
        ? '<a class="dropdown-item text-warning" onclick="changeStatus(' . $row->ID_TYPE_GROUPE . ',0)">
                <i class="fa fa-ban"></i> Désactiver
           </a>'
        : '<a class="dropdown-item text-success" onclick="changeStatus(' . $row->ID_TYPE_GROUPE . ',1)">
                <i class="fa fa-check"></i> Activer
           </a>';

    // ACTIONS
    $actions = '
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cogs"></i>
            Actions
        </button>

        <div class="dropdown-menu">

            <a class="dropdown-item" onclick="editType(' . $row->ID_TYPE_GROUPE . ')">
                <i class="fa fa-edit text-primary"></i> Modifier
            </a>

            ' . $toggleStatus . '

            <div class="dropdown-divider"></div>

            <a class="dropdown-item text-danger" onclick="deleteType(' . $row->ID_TYPE_GROUPE . ')">
                <i class="fa fa-trash"></i> Supprimer
            </a>

        </div>
    </div>';


    $sub = [];
    $sub[] = $i++;
    $sub[] = '<span data-toggle="tooltip"
                data-placement="top"
                title="' . htmlspecialchars($fullDescription, ENT_QUOTES, 'UTF-8') . '">'
        . htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8')
        . '</span>';

    $sub[] = $status;
    $sub[] = $actions;

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


public function changeStatut()
{
    $id = $this->request->getPost('ID_TYPE_GROUPE');
    $statut = $this->request->getPost('STATUT');

    $this->db->table('type_groupes')
        ->where('ID_TYPE_GROUPE', $id)
        ->update([
            'STATUT' => $statut
        ]);

    return $this->response->setJSON([
        'success' => true,
        'message' => ($statut == 1)
            ? 'type de groupe activé avec succès'
            : 'type de groupe désactivé avec succès'
    ]);
}



public function save()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON(['success' => false]);
    }

   $rules = [
    'DESC_GROUPE' => 'required|min_length[3]'
];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_TYPE_GROUPE');
    $db = \Config\Database::connect();
    $db->transBegin();

    try {

      $data = [
  
       'DESC_GROUPE' => $this->request->getPost('DESC_GROUPE'),
     ];

        $builder = $db->table('type_groupes');

        if (!empty($id)) {

            $builder->where('ID_TYPE_GROUPE', $id)->update($data);
            $message = "Type de groupe modifié";

        } else {

            $builder->insert($data);
            $message = "Type de groupe ajouté";
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

    $data = $db->table('type_groupes')
        ->where('ID_TYPE_GROUPE', $id)
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
    $id = $this->request->getPost('ID_TYPE_GROUPE');

    $db = \Config\Database::connect();

     $db->table('type_groupes')->where('ID_TYPE_GROUPE', $id)->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Type de groupe supprimé'
    ]);
}

private function countAll()
{
    return $this->db->table('type_groupes')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM type_groupes
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}