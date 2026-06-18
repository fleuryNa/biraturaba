<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;


class Contacts extends BaseController
{

 protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data['title'] = 'Liste de Contacts';

        return view('App\Modules\Features\Views\ContactsView', $data);
    }
    
public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    $query_principal = "SELECT * FROM contacts WHERE 1";

    $group = "";
    $critaire = "";

    // LIMIT
    $limit = 'LIMIT 0,1000';
    if ($_POST['length'] != -1) {
        $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }

    // ORDER
    $order_column = [
        'ID_CONTACT',
        'NAME_CONTACT',
        'EMAIL',
        'SUBJECT',
        'MESSAGE_CONTACT',
        'IS_READ',
        'DATE_INSERTION',
        'ID_CONTACT'
    ];

    if (isset($_POST['order'][0]['column'])) {

        $colIndex = $_POST['order'][0]['column'];

        $order_by = isset($order_column[$colIndex])
            ? ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir']
            : ' ORDER BY ID_CONTACT DESC';

    } else {
        $order_by = ' ORDER BY ID_CONTACT DESC';
    }

    // SEARCH
    $search = !empty($var_search)
        ? " AND (
            NAME_CONTACT LIKE '%$var_search%' OR
            EMAIL LIKE '%$var_search%' OR
            SUBJECT LIKE '%$var_search%' OR
            MESSAGE_CONTACT LIKE '%$var_search%'
        )"
        : "";

    $query_secondaire = $query_principal .' '. $search .' '. $group .' '. $order_by .' '. $limit;
    $query_filter     = $query_principal .' '. $search .' '. $group;

    $fetch_data = $this->model->datatable($query_secondaire);

    $data = [];
    $i = $_POST['start'] + 1;

    foreach ($fetch_data as $row) {

        $status = ($row->IS_READ == 1)
            ? '<span class="badge bg-success">Lu</span>'
            : '<span class="badge bg-warning">Non lu</span>';

        $sub = [];

        $sub[] = $i++;
        $sub[] = $row->NAME_CONTACT;
        $sub[] = $row->EMAIL;
        $sub[] = $row->SUBJECT;
        $sub[] = $row->MESSAGE_CONTACT;
        $sub[] = $status;
        $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

        $sub[] = '
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="viewContact('.$row->ID_CONTACT.')">
                    Voir
                </a>
                <a class="dropdown-item" onclick="markAsRead('.$row->ID_CONTACT.')">
                    Marquer comme lu
                </a>
                <a class="dropdown-item" onclick="deleteContact('.$row->ID_CONTACT.')">
                    Supprimer
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


public function markAsRead()
{
    $id = $this->request->getPost('ID_CONTACT');

    $this->db->table('contacts')
        ->where('ID_CONTACT', $id)
        ->update(['IS_READ' => 1]);

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Message marqué comme lu'
    ]);
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
        'NAME_CONTACT' => 'required|min_length[3]',
        'EMAIL' => 'required|valid_email',
        'SUBJECT' => 'required|min_length[3]',
        'MESSAGE_CONTACT' => 'required|min_length[5]'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_CONTACT');

    $db = \Config\Database::connect();
    $db->transBegin();

    try {

        $data = [
            'NAME_CONTACT' => $this->request->getPost('NAME_CONTACT'),
            'EMAIL' => $this->request->getPost('EMAIL'),
            'SUBJECT' => $this->request->getPost('SUBJECT'),
            'MESSAGE_CONTACT' => $this->request->getPost('MESSAGE_CONTACT'),
        ];

        $builder = $db->table('contacts');

        // =========================
        // UPDATE
        // =========================
        if (!empty($id)) {

            $builder->where('ID_CONTACT', $id)->update($data);
            $message = "Contact mis à jour avec succès";

        } 
        // =========================
        // INSERT
        // =========================
        else {

            $data['IS_READ'] = 0;
            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');

            $builder->insert($data);
            $message = "Contact ajouté avec succès";
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
    $data = $this->db->table('contacts')
        ->where('ID_CONTACT', $id)
        ->get()
        ->getRow();

    if (!$data) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Contact introuvable'
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
    $id = $this->request->getPost('ID_CONTACT');

    $this->db->table('contacts')
        ->where('ID_CONTACT', $id)
        ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Contact supprimé'
    ]);
}
private function countAll()
{
    return $this->db->table('contacts')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM contacts
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}