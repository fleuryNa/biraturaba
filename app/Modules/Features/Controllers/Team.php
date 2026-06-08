<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;


class Team extends BaseController
{

    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function index()
    {
        $data['title'] = 'Liste de membres de l\'équipe';

        return view('App\Modules\Features\Views\TeamView', $data);
    }

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    $query_principal = "SELECT * FROM team WHERE 1";

    $group = "";
    $critaire = "";

    // LIMIT
    $limit = 'LIMIT 0,1000';
    if ($_POST['length'] != -1) {
        $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }

    // ORDER
    $order_column = [
        'ID_TEAM',
        'NOM',
        'POSTE',
        'NIVEAU',
        'ORDRE',
        'GMAIL',
        'IS_ACTIF'
    ];

    if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

        $colIndex = $_POST['order'][0]['column'];

        if (isset($order_column[$colIndex])) {
            $order_by = ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir'];
        } else {
            $order_by = ' ORDER BY ORDRE ASC';
        }

    } else {
        $order_by = ' ORDER BY ORDRE ASC';
    }

    // SEARCH
    $search = !empty($var_search)
        ? " AND (
                NOM LIKE '%$var_search%'
                OR POSTE LIKE '%$var_search%'
                OR NIVEAU LIKE '%$var_search%'
            )"
        : "";

    $query_secondaire = $query_principal . $critaire . $search . $group . $order_by . ' ' . $limit;
    $query_filter = $query_principal . $critaire . $search . $group;

    $fetch_data = $this->model->datatable($query_secondaire);

    $data = [];
    $i = $_POST['start'] + 1;

    foreach ($fetch_data as $row) {

        $photo = !empty($row->PHOTO)
            ? '<img src="' . base_url('uploads/team/' . $row->PHOTO) . '" width="60" height="60" style="border-radius:50%">'
            : '<span class="badge badge-secondary">Aucune</span>';

        $statut = $row->IS_ACTIF == 1
            ? '<span class="badge badge-success">Actif</span>'
            : '<span class="badge badge-danger">Inactif</span>';

        $sub = [];

        $sub[] = $i++;
        $sub[] = $photo;
        $sub[] = $row->NOM;
        $sub[] = $row->POSTE;
        $sub[] = $row->NIVEAU;
        $sub[] = $row->ORDRE;
        $sub[] = $row->GMAIL;
        $sub[] = $statut;

        $sub[] = '
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cogs"></i> Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="editTeam(' . $row->ID_TEAM . ')">
                    <i class="fa fa-edit"></i> Modifier
                </a>

                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="deleteTeam(' . $row->ID_TEAM . ')">
                    <i class="fa fa-trash"></i> Supprimer
                </a>
            </div>
        </div>';

        $data[] = $sub;
    }

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

    $rules = [
        'NOM'       => 'required|min_length[2]',
        'POSTE'     => 'required',
        'NIVEAU'    => 'permit_empty',
        'ORDRE'     => 'required|integer',
        'IS_ACTIF'  => 'required'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_TEAM');

    $db = \Config\Database::connect();
    $db->transStart();

    try {

        $photo = $this->request->getFile('PHOTO');
        $fileName = null;

        // =====================
        // UPLOAD PHOTO
        // =====================
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {

            $mimeAllowed = [
                'image/jpeg',
                'image/jpg',
                'image/png',
                'image/webp'
            ];

            if (!in_array($photo->getMimeType(), $mimeAllowed)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Format image invalide'
                ]);
            }

            $fileName = $photo->getRandomName();
            $photo->move(FCPATH . 'uploads/team', $fileName);
        }

        // =====================
        // DATA
        // =====================
        $data = [
            'NOM'       => trim($this->request->getPost('NOM')),
            'POSTE'     => trim($this->request->getPost('POSTE')),
            'NIVEAU'    => trim($this->request->getPost('NIVEAU')),
            'FACEBOOK'  => trim($this->request->getPost('FACEBOOK')),
            'TWITTER'   => trim($this->request->getPost('TWITTER')),
            'GMAIL'     => trim($this->request->getPost('EMAIL')),
            'ORDRE'     => (int)$this->request->getPost('ORDRE'),
            'IS_ACTIF'  => (int)$this->request->getPost('IS_ACTIF')
        ];

        if ($fileName) {
            $data['PHOTO'] = $fileName;
        }

        $builder = $db->table('team');

        // =====================
        // UPDATE
        // =====================
        if (!empty($id)) {

            $old = $builder
                ->where('ID_TEAM', $id)
                ->get()
                ->getRow();

            if ($old && !empty($fileName) && !empty($old->PHOTO)) {

                $oldPhoto = FCPATH . 'uploads/team/' . $old->PHOTO;

                if (file_exists($oldPhoto)) {
                    unlink($oldPhoto);
                }
            }

            $builder->where('ID_TEAM', $id)->update($data);

            $message = "Membre modifié avec succès";
        }
        // =====================
        // INSERT
        // =====================
        else {

            $builder->insert($data);

            $message = "Membre ajouté avec succès";
        }

        $db->transComplete();

        if (!$db->transStatus()) {
            throw new \Exception('Erreur transaction');
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => $message
        ]);

    } catch (\Exception $e) {

        return $this->response->setJSON([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}

public function getOne($id)
{

    $db = \Config\Database::connect();
    $data = $this->db->table('team')
        ->where('ID_TEAM', $id)
        ->get()
        ->getRow();

    if (!$data) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Membre introuvable'
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
    $id = $this->request->getPost('ID_TEAM');

    $team = $this->db->table('team')
        ->where('ID_TEAM', $id)
        ->get()
        ->getRow();

    if (!$team) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Membre introuvable'
        ]);
    }

    // =========================
    // SUPPRESSION PHOTO
    // =========================
    if (!empty($team->PHOTO)) {

        $path = FCPATH . 'uploads/team/' . $team->PHOTO;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    // =========================
    // DELETE DB
    // =========================
    $this->db->table('team')
        ->where('ID_TEAM', $id)
        ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Membre supprimé avec succès'
    ]);
}

private function countAll()
{
    return $this->db->table('team')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM team
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}