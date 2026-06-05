<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;

class Projet extends BaseController
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
        return view('App\Modules\Features\Views\projet\ProjetView');
    }

    // =========================================================
    // DATATABLE LISTE PROJETS
    // ========================================================


    public function getList(): mixed
    {
        $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
        $var_search = str_replace("'", "\'", $var_search);

        $query_principal = "SELECT * FROM projet WHERE 1 ";

        $group = "";
        $critaire = "";

        $limit = 'LIMIT 0,1000';
        if ($_POST['length'] != -1) {
            $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
        }

      $order_column = ['ID_PROJET', 'TITRE', 'DESCRIPTION', 'IMAGE', 'DATE_CREATION', 'ID_PROJET'];

if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

    $colIndex = $_POST['order'][0]['column'];

    if (isset($order_column[$colIndex])) {
        $order_by = ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir'];
    } else {
        $order_by = ' ORDER BY ID_PROJET DESC';
    }

} else {
    $order_by = ' ORDER BY ID_PROJET DESC';
}

        if (!empty($var_search)) {
            $var_search = str_replace("'", "\'", $var_search);
            $search = " AND (TITRE LIKE '%$var_search%' OR DESCRIPTION LIKE '%$var_search%')";
        }

        $search = !empty($_POST['search']['value']) ? (" AND (TITRE LIKE '%$var_search%' OR DESCRIPTION LIKE '%$var_search%'") : '';

        $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group . ' ' . $order_by . ' ' . $limit;
        $query_filter = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group;

        $fetch_captage = $this->model->datatable($query_secondaire);


        $data = [];
    $i = $_POST['start'] + 1; // For proper pagination numbering
    
    foreach ($fetch_captage as $row) {
       $img = !empty($row->IMAGE)
       ? '<img src="' . base_url('uploads/projets/' . $row->IMAGE) . '" width="50">'
       : '';

       $sub = [];
       $sub[] = $i++;
       $sub[] = $row->TITRE;
       $sub[] = $row->DESCRIPTION;
       $sub[] = $img;
       $sub[] = date('d/m/Y', strtotime($row->DATE_CREATION));

       $sub[] = '
       
       <div class="btn-group">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			<i class="fa fa-cogs"></i> Actions <i class="fa fa-angle-down"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item"onclick="editProjet(' . $row->ID_PROJET . ')">
			<i class="fa fa-edit"></i> Modifier
			</a>
			<a class="dropdown-item" onclick="deleteProjet(' . $row->ID_PROJET . ')">
			<i class="fa fa-trash"></i> Effacer
			</a>
	
			</div>
			</div>
       ';

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

    // VALIDATION
    $rules = [
        'TITRE' => 'required|min_length[3]',
        'DESCRIPTION' => 'required|min_length[5]'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_PROJET');

    $db = \Config\Database::connect();
    $db->transStart(); // 🔥 TRANSACTION

    try {

        $image = $this->request->getFile('IMAGE');
        $fileName = null;

        // UPLOAD IMAGE
        if ($image && $image->isValid() && !$image->hasMoved()) {

            // Vérifier type fichier
            if (!in_array($image->getMimeType(), ['image/jpeg', 'image/png', 'image/jpg'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Format image invalide'
                ]);
            }

            $fileName = $image->getRandomName();
            $image->move('uploads/projets', $fileName);
        }

        $data = [
            'TITRE' => trim($this->request->getPost('TITRE')),
            'DESCRIPTION' => trim($this->request->getPost('DESCRIPTION'))
        ];

        if ($fileName) {
            $data['IMAGE'] = $fileName;
        }

        $builder = $db->table('projet');

        if ($id) {

            $builder->where('ID_PROJET', $id)->update($data);
            $message = "Projet modifié avec succès";

        } else {

            $data['DATE_CREATION'] = date('Y-m-d H:i:s');
            $builder->insert($data);
            $message = "Projet ajouté avec succès";
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
public function getProjet($id)
{
    $data = $this->db->table('projet')
    ->where('ID_PROJET', $id)
    ->get()
    ->getRow();

    return $this->response->setJSON([
        'success' => true,
        'data' => $data
    ]);
}

    // =========================================================
    // DELETE PROJET
    // =========================================================
public function delete()
{
    $id = $this->request->getPost('ID_PROJET');

    $this->db->table('projet')
    ->where('ID_PROJET', $id)
    ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Projet supprimé'
    ]);
}

    // =========================================================
    // COUNT FUNCTIONS
    // =========================================================
private function countAll()
{
    return $this->db->table('projet')->countAllResults();
}

private function countFiltered($search)
{
    $sql = "SELECT COUNT(*) as total FROM projet WHERE 1=1 $search";
    return $this->db->query($sql)->getRow()->total;
}
}