<?php

namespace App\Modules\Strategie\Controllers;

use App\Controllers\BaseController;


class ApprocheBackend extends BaseController
{

 protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data['title'] = 'Liste des Approches';

        return view('App\Modules\Strategie\Views\ApprocheBackendView', $data);
    }

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    // =========================
    // TABLE BLOGS
    // =========================
   $query_principal = "SELECT * FROM activites WHERE 1";

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
      // ORDER
$order_column = [
    'ID_ACTIVITE',
    'TITRE',
    'IMAGE',
    'DESCRIPTION',
    'ORDRE_AFFICHAGE',
    'STATUT',
    'DATE_INSERTION',
    'ID_ACTIVITE'
];

if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

    $colIndex = $_POST['order'][0]['column'];

    $order_by = isset($order_column[$colIndex])
        ? ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir']
        : ' ORDER BY ID_ACTIVITE DESC';

} else {
    $order_by = ' ORDER BY ID_ACTIVITE DESC';
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

    // IMAGE
    $img = !empty($row->IMAGE)
        ? '<img src="' . base_url('uploads/activites/' . $row->IMAGE) . '" 
                width="60" height="60" style="object-fit:cover;border-radius:6px;">'
        : '<span class="text-muted">Aucune image</span>';

    // DESCRIPTION (safe + clean)
    $fullDescription = iconv('UTF-8', 'UTF-8//IGNORE', $row->DESCRIPTION);

        $shortDescription = mb_strlen($fullDescription, 'UTF-8') > 60
            ? mb_substr($fullDescription, 0, 60, 'UTF-8') . '...'
            : $fullDescription;

    // STATUS
    $status = $row->STATUT == 1
        ? '<span class="badge bg-success"><i class="fa fa-check"></i> Actif</span>'
        : '<span class="badge bg-danger"><i class="fa fa-times"></i> Inactif</span>';

    // ACTION ACTIVER / DESACTIVER
    $toggleStatus = $row->STATUT == 1
        ? '<a class="dropdown-item text-warning" onclick="changeStatus(' . $row->ID_ACTIVITE . ',0)">
                <i class="fa fa-ban"></i> Désactiver
           </a>'
        : '<a class="dropdown-item text-success" onclick="changeStatus(' . $row->ID_ACTIVITE . ',1)">
                <i class="fa fa-check"></i> Activer
           </a>';

    // ACTIONS
    $actions = '
    <div class="btn-group">
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cogs"></i>
        </button>

        <div class="dropdown-menu">

            <a class="dropdown-item" onclick="editActivite(' . $row->ID_ACTIVITE . ')">
                <i class="fa fa-edit text-primary"></i> Modifier
            </a>

            ' . $toggleStatus . '

            <div class="dropdown-divider"></div>

            <a class="dropdown-item text-danger" onclick="deleteActivite(' . $row->ID_ACTIVITE . ')">
                <i class="fa fa-trash"></i> Supprimer
            </a>

        </div>
    </div>';

    $sub = [];
    $sub[] = $i++;
    $sub[] = esc($row->TITRE);
    $sub[] = $img;
     $sub[] = '<span data-toggle="tooltip"
                data-placement="top"
                title="' . htmlspecialchars($fullDescription, ENT_QUOTES, 'UTF-8') . '">'
        . htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8')
        . '</span>';
    $sub[] = $row->ORDRE_AFFICHAGE;

    $sub[] = $status;
    $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

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
            'message' => 'Erreur de validation',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_ACTIVITE');

    $db = \Config\Database::connect();
    $db->transBegin();

    try {

        $fileName = null;
        $img = $this->request->getFile('IMAGE');

        if ($img && $img->isValid() && !$img->hasMoved()) {

            $allowed = [
                'image/jpeg',
                'image/png',
                'image/jpg',
                'image/webp'
            ];

            if (!in_array($img->getMimeType(), $allowed)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Image invalide'
                ]);
            }

            $fileName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/activites', $fileName);
        }

        $data = [
            'TITRE' => $this->request->getPost('TITRE'),
            'DESCRIPTION' => $this->request->getPost('DESCRIPTION'),
            'ORDRE_AFFICHAGE' => $this->request->getPost('ORDRE_AFFICHAGE'),
            'STATUT' => $this->request->getPost('STATUT')
        ];

        if ($fileName) {
            $data['IMAGE'] = $fileName;
        }

        $builder = $db->table('activites');

        if (!empty($id)) {

            $old = $builder
                ->where('ID_ACTIVITE', $id)
                ->get()
                ->getRow();

            if ($old && $fileName && !empty($old->IMAGE)) {

                $path = FCPATH . 'uploads/activites/' . $old->IMAGE;

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $builder
                ->where('ID_ACTIVITE', $id)
                ->update($data);

            $message = 'Activité modifiée';

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');

            $builder->insert($data);

            $message = 'Activité ajoutée';
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
    $data = $this->db->table('activites')
        ->where('ID_ACTIVITE', $id)
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
    $id = $this->request->getPost('ID_ACTIVITE');

    $db = \Config\Database::connect();

    $old = $db->table('activites')
        ->where('ID_ACTIVITE', $id)
        ->get()
        ->getRow();

    if ($old && !empty($old->IMAGE)) {
        $path = FCPATH.'uploads/activites/'.$old->IMAGE;
        if (file_exists($path)) unlink($path);
    }

    $db->table('activites')->where('ID_ACTIVITE', $id)->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Activité supprimée'
    ]);
}

private function countAll()
{
    return $this->db->table('activites')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM activites
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}