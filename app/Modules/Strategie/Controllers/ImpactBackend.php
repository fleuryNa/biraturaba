<?php

namespace App\Modules\Strategie\Controllers;

use App\Controllers\BaseController;


class ImpactBackend extends BaseController
{

 protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data['title'] = 'Liste des Impacts';

        return view('App\Modules\Strategie\Views\ImpactBackendView', $data);
    }
public function getList()
{
    $var_search = !empty($_POST['search']['value'])
        ? $_POST['search']['value']
        : '';

    $query_principal = "SELECT * FROM impact WHERE 1";

    $search = "";

    if (!empty($var_search)) {

        $search = " AND (
            BENEFICIAIRE LIKE '%$var_search%'
            OR BENEFICIEARE_FEEMME LIKE '%$var_search%'
            OR CREDIT_OCTROYE_GROUP LIKE '%$var_search%'
            OR TAUX_MOYEN LIKE '%$var_search%'
        )";
    }

    $limit = '';

    if ($_POST['length'] != -1) {
        $limit = " LIMIT " . $_POST['start'] . "," . $_POST['length'];
    }

    $query = $query_principal . $search .
        " ORDER BY ID_IMPACT DESC " .
        $limit;

    $fetch_data = $this->model->datatable($query);

    $data = [];
    $i = $_POST['start'] + 1;

    foreach ($fetch_data as $row) {

        $image = '';

        if (!empty($row->IMAGE_IMPACT)) {

            $image = '<img src="' .
                base_url('uploads/impact/' . $row->IMAGE_IMPACT) .
                '" width="60">';
        }

        $status = $row->STATUT == 1
            ? '<span class="badge badge-success">Actif</span>'
            : '<span class="badge badge-danger">Inactif</span>';

     $actionStatut = '';

if ($row->STATUT == 1) {
    $actionStatut = '
        <a class="dropdown-item text-warning" onclick="changeStatut(' . $row->ID_IMPACT . ',0)">
            <i class="fa fa-ban"></i> Désactiver
        </a>';
} else {
    $actionStatut = '
        <a class="dropdown-item text-success" onclick="changeStatut(' . $row->ID_IMPACT . ',1)">
            <i class="fa fa-check"></i> Activer
        </a>';
}

$actions = '
<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-cogs"></i> Actions
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" onclick="editImpact(' . $row->ID_IMPACT . ')">
            <i class="fa fa-edit"></i> Modifier
        </a>

        ' . $actionStatut . '

        <a class="dropdown-item text-danger" onclick="deleteImpact(' . $row->ID_IMPACT . ')">
            <i class="fa fa-trash"></i> Supprimer
        </a>
    </div>
</div>';

        $sub = [];

        $sub[] = $i++;
        $sub[] = $image;
        $sub[] = $row->BENEFICIAIRE;
        $sub[] = $row->BENEFICIEARE_FEEMME;
        $sub[] = $row->CREDIT_OCTROYE_GROUP;
        $sub[] = $row->TAUX_MOYEN . '%';
        $sub[] = $row->EPARGNE_GROUPE;
        $sub[] = $row->INTERET_GENERER_CREDIT;
        $sub[] = $row->EVOLUTION_CAPITAL;
        $sub[] = $status;
        $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));
        $sub[] =$actions;

        $data[] = $sub;
    }

    return $this->response->setJSON([
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $this->model->all_data($query_principal),
        "recordsFiltered" => $this->model->all_data($query_principal . $search),
        "data" => $data
    ]);
}

public function changeStatut()
{
    $id = $this->request->getPost('ID_IMPACT');
    $statut = $this->request->getPost('STATUT');

    $this->db->table('impact')
        ->where('ID_IMPACT', $id)
        ->update([
            'STATUT' => $statut
        ]);

    return $this->response->setJSON([
        'success' => true,
        'message' => ($statut == 1)
            ? 'Impact activé avec succès'
            : 'Impact désactivé avec succès'
    ]);
}

public function save()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON([
            'success' => false
        ]);
    }

    $rules = [
        'BENEFICIAIRE' => 'required|numeric',
        'BENEFICIEARE_FEEMME' => 'required|numeric',
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_IMPACT');

    $db = \Config\Database::connect();
    $db->transBegin();

    try {

        $fileName = null;
        $image = $this->request->getFile('IMAGE_IMPACT');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            $fileName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/impact',
                $fileName
            );
        }

        $data = [
            'BENEFICIAIRE' => $this->request->getPost('BENEFICIAIRE'),
            'BENEFICIEARE_FEEMME' => $this->request->getPost('BENEFICIEARE_FEEMME'),
            'CREDIT_OCTROYE_GROUP' => $this->request->getPost('CREDIT_OCTROYE_GROUP'),
            'TAUX_MOYEN' => $this->request->getPost('TAUX_MOYEN'),
            'EPARGNE_GROUPE' => $this->request->getPost('EPARGNE_GROUPE'),
            'INTERET_GENERER_CREDIT' => $this->request->getPost('INTERET_GENERER_CREDIT'),
            'EVOLUTION_CAPITAL' => $this->request->getPost('EVOLUTION_CAPITAL'),
            'STATUT' => $this->request->getPost('STATUT')
        ];

        if ($fileName) {
            $data['IMAGE_IMPACT'] = $fileName;
        }

        $builder = $db->table('impact');

        if (!empty($id)) {

            $old = $builder->where('ID_IMPACT', $id)
                ->get()
                ->getRow();

            if ($old && $fileName && !empty($old->IMAGE_IMPACT)) {

                $oldFile = FCPATH . 'uploads/impact/' . $old->IMAGE_IMPACT;

                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            $builder->where('ID_IMPACT', $id)
                ->update($data);

            $message = "Impact modifié avec succès";

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');

            $builder->insert($data);

            $message = "Impact ajouté avec succès";
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
            'message' => $e->getMessage()
        ]);
    }
}

public function getOne($id)
{
    $data = $this->db->table('impact')
        ->where('ID_IMPACT', $id)
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
    $id = $this->request->getPost('ID_IMPACT');

    $impact = $this->db->table('impact')
        ->where('ID_IMPACT', $id)
        ->get()
        ->getRow();

    if ($impact && !empty($impact->IMAGE_IMPACT)) {

        $file = FCPATH . 'uploads/impact/' . $impact->IMAGE_IMPACT;

        if (file_exists($file)) {
            unlink($file);
        }
    }

    $this->db->table('impact')
        ->where('ID_IMPACT', $id)
        ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Impact supprimé avec succès'
    ]);
}
private function countAll()
{
    return $this->db->table('impact')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM impact
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}