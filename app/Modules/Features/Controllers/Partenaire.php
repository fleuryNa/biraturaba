<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;

class Partenaire extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * PAGE LISTE
     */
    public function index()
    {
        return view('App\Modules\Features\Views\partenaire\PartenaireView');
    }

    // =========================================================
    // DATATABLE LISTE PROJETS
    // ========================================================


    public function getList(): mixed
    {
        $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
        $var_search = str_replace("'", "\'", $var_search);

        $query_principal = "SELECT * FROM partners WHERE 1 ";

        $group = "";
        $critaire = "";


        $limit = 'LIMIT 0,1000';
        if ($_POST['length'] != -1) {
            $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
        }

    $order_column = [
    'ID_PARTNERS',
    'NAME',
    'LOGO',
    'LINK_PARTNER',
    'STATUT',
    'DATE_INSERTION',
    'ID_PARTNERS'
];

if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

    $colIndex = $_POST['order'][0]['column'];

    if (isset($order_column[$colIndex])) {
        $order_by = ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir'];
    } else {
        $order_by = ' ORDER BY ID_PARTNERS DESC';
    }

} else {
    $order_by = ' ORDER BY ID_PARTNERS DESC';
}
$search = !empty($_POST['search']['value'])
    ? (" AND (NAME LIKE '%$var_search%' OR LINK_PARTNER LIKE '%$var_search%')")
    : '';

        $search = !empty($_POST['search']['value']) ? (" AND (TITRE LIKE '%$var_search%' OR DESCRIPTION LIKE '%$var_search%'") : '';

        $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group . ' ' . $order_by . ' ' . $limit;
        $query_filter = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group;

        $fetch_captage = $this->model->datatable($query_secondaire);


        $data = [];
    $i = $_POST['start'] + 1; // For proper pagination numbering
    
   foreach ($fetch_captage as $row) {

    $logo = !empty($row->LOGO)
        ? '<img src="' . base_url('uploads/partners/' . $row->LOGO) . '" width="50">'
        : '';

    $sub = [];
    $sub[] = $i++;
    $sub[] = $row->NAME;
    $sub[] = $logo;
    $sub[] = '<a href="' . $row->LINK_PARTNER . '" target="_blank">' . $row->LINK_PARTNER . '</a>';

    $sub[] = $row->STATUT == 1
        ? '<span class="badge badge-success">Actif</span>'
        : '<span class="badge badge-danger">Inactif</span>';

    $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

    $sub[] = '
    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-cogs"></i> Actions
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" onclick="editPartner(' . $row->ID_PARTNERS . ')">
                <i class="fa fa-edit"></i> Modifier
            </a>
            <a class="dropdown-item" onclick="deletePartner(' . $row->ID_PARTNERS . ')">
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

    // =========================================================
    // AJOUT / UPDATE PROJET
    // =========================================================
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
        'NAME' => 'required|min_length[3]',
        'LINK_PARTNER' => 'permit_empty|valid_url'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_PARTNERS');

    $db = \Config\Database::connect();
    $db->transStart();

    try {

        $logo = $this->request->getFile('LOGO');
        $fileName = null;

        // =========================
        // UPLOAD LOGO
        // =========================
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {

            // Vérifier type image
            if (!in_array($logo->getMimeType(), [
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

            $fileName = $logo->getRandomName();
            $logo->move('uploads/partners', $fileName);
        }

        // =========================
        // DATA
        // =========================
        $data = [
            'NAME' => trim($this->request->getPost('NAME')),
            'LINK_PARTNER' => trim($this->request->getPost('LINK_PARTNER')),
            'STATUT' => $this->request->getPost('STATUT')
        ];

        if ($fileName) {
            $data['LOGO'] = $fileName;
        }

        $builder = $db->table('partners');

        // =========================
        // INSERT / UPDATE
        // =========================
        if (!empty($id)) {

            // OPTION: supprimer ancien logo
            $old = $builder->where('ID_PARTNERS', $id)->get()->getRow();
            if ($old && !empty($fileName) && !empty($old->LOGO)) {
                $oldPath = FCPATH . 'uploads/partners/' . $old->LOGO;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $builder->where('ID_PARTNERS', $id)->update($data);
            $message = "Partenaire modifié avec succès";

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');

            $builder->insert($data);
            $message = "Partenaire ajouté avec succès";
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
    // =========================================================
    // GET ONE PROJET
    // =========================================================
// =========================================================
// GET ONE PARTNER
// =========================================================
public function getOne($id)
{
    $data = $this->db->table('partners')
        ->where('ID_PARTNERS', $id)
        ->get()
        ->getRow();

    if (!$data) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Partenaire introuvable'
        ]);
    }

    return $this->response->setJSON([
        'success' => true,
        'data' => $data
    ]);
}

    // =========================================================
    // DELETE PROJET
    // =========================================================
// =========================================================
// DELETE PARTNER
// =========================================================
public function delete()
{
    $id = $this->request->getPost('ID_PARTNERS');

    $partner = $this->db->table('partners')
        ->where('ID_PARTNERS', $id)
        ->get()
        ->getRow();

    if (!$partner) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Partenaire introuvable'
        ]);
    }

    // Supprimer le logo physique
    if (!empty($partner->LOGO)) {
        $path = FCPATH . 'uploads/partners/' . $partner->LOGO;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    $this->db->table('partners')
        ->where('ID_PARTNERS', $id)
        ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Partenaire supprimé avec succès'
    ]);
}

    // =========================================================
    // COUNT FUNCTIONS
    // =========================================================
// =========================================================
// COUNT ALL
// =========================================================
private function countAll()
{
    return $this->db->table('partners')
        ->countAllResults();
}
// =========================================================
// COUNT FILTERED
// =========================================================
private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM partners
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}
}