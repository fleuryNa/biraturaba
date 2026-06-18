<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;

class About extends BaseController
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
        return view('App\Modules\Features\Views\AboutView');
    }

    // =========================================================
    // DATATABLE LISTE PROJETS
    // ========================================================

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    $query_principal = "SELECT * FROM about WHERE 1";

    $limit = 'LIMIT 0,1000';

    if ($_POST['length'] != -1) {
        $limit = 'LIMIT '.$_POST["start"].','.$_POST["length"];
    }

    $order_column = [
        'ID_ABOUT',
        'TITRE',
        'DESCRIPTION',
        'IMAGE',
        'TEXTE_BOUTON',
        'LIEN_BOUTON',
        'DATE_CREATION',
        'ID_ABOUT'
    ];

    if (isset($_POST['order'][0]['column'])) {

        $colIndex = $_POST['order'][0]['column'];

        $order_by = isset($order_column[$colIndex])
            ? ' ORDER BY '.$order_column[$colIndex].' '.$_POST['order'][0]['dir']
            : ' ORDER BY ID_ABOUT DESC';

    } else {
        $order_by = ' ORDER BY ID_ABOUT DESC';
    }

    $search = !empty($var_search)
        ? " AND (
            TITRE LIKE '%$var_search%'
            OR DESCRIPTION LIKE '%$var_search%'
            OR TEXTE_BOUTON LIKE '%$var_search%'
        )"
        : "";

    $query_secondaire = $query_principal.' '.$search.' '.$order_by.' '.$limit;
    $query_filter     = $query_principal.' '.$search;

    $fetch_data = $this->model->datatable($query_secondaire);

    $data = [];
    $i = $_POST['start'] + 1;

    foreach ($fetch_data as $row) {

        $image = !empty($row->IMAGE)
            ? '<img src="'.base_url('uploads/about/'.$row->IMAGE).'" width="60">'
            : '';

     $fullDescription = iconv('UTF-8', 'UTF-8//IGNORE', $row->DESCRIPTION);

        $shortDescription = mb_strlen($fullDescription, 'UTF-8') > 60
            ? mb_substr($fullDescription, 0, 60, 'UTF-8') . '...'
            : $fullDescription;

                $sub = [];
        $sub[] = $i++;
        $sub[] = $row->TITRE;
        $sub[] = '<span data-toggle="tooltip"
                data-placement="top"
                title="' . htmlspecialchars($fullDescription, ENT_QUOTES, 'UTF-8') . '">'
        . htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8')
        . '</span>';
        $sub[] = $image;
        $sub[] = $row->TEXTE_BOUTON;
        $sub[] = '<a href="'.$row->LIEN_BOUTON.'" target="_blank">Lien</a>';
        $sub[] = date('d/m/Y', strtotime($row->DATE_CREATION));

        $sub[] = '
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cogs"></i> Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="editAbout('.$row->ID_ABOUT.')">
                    <i class="fa fa-edit"></i> Modifier
                </a>
                <a class="dropdown-item text-danger" onclick="deleteAbout('.$row->ID_ABOUT.')">
                    <i class="fa fa-trash"></i> Supprimer
                </a>
            </div>
        </div>';

        $data[] = $sub;
    }
//     foreach ($data[0] as $key => $value) {
//     if (is_string($value)) {
//         echo "Colonne $key : ";
//         var_dump(json_encode($value));
//         echo "<br><br>";
//     }
// }
// exit;


    return $this->response->setJSON([
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $this->model->all_data($query_principal),
        "recordsFiltered" => $this->model->all_data($query_filter),
        "data" => $data
    ]);
}
    // =========================================================
    // AJOUT / UPDATE PROJET
    // =========================================================
public function save()
{
    $id = $this->request->getPost('ID_ABOUT');

    $image = $this->request->getFile('IMAGE');
    $fileName = null;

    if ($image && $image->isValid() && !$image->hasMoved()) {

        $fileName = $image->getRandomName();
        $image->move(FCPATH.'uploads/about', $fileName);
    }

    $data = [
        'TITRE'         => $this->request->getPost('TITRE'),
        'DESCRIPTION'   => $this->request->getPost('DESCRIPTION'),
        'TEXTE_BOUTON'  => $this->request->getPost('TEXTE_BOUTON'),
        'LIEN_BOUTON'   => $this->request->getPost('LIEN_BOUTON'),
    ];

    if ($fileName) {
        $data['IMAGE'] = $fileName;
    }

    $builder = $this->db->table('about');

    if (!empty($id)) {

        $old = $builder->where('ID_ABOUT', $id)->get()->getRow();

        if ($old && $fileName && !empty($old->IMAGE)) {

            $oldPath = FCPATH.'uploads/about/'.$old->IMAGE;

            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $builder->where('ID_ABOUT', $id)->update($data);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Modification effectuée'
        ]);
    }

    $data['DATE_CREATION'] = date('Y-m-d H:i:s');

    $builder->insert($data);

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Enregistrement effectué'
    ]);
}
    // =========================================================
    // GET ONE PROJET
    // =========================================================
// =========================================================
// GET ONE PARTNER
// =========================================================
public function getOne($id)
{
    $about = $this->db->table('about')
        ->where('ID_ABOUT', $id)
        ->get()
        ->getRow();

    return $this->response->setJSON([
        'success' => true,
        'data' => $about
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
    $id = $this->request->getPost('ID_ABOUT');

    $about = $this->db->table('about')
        ->where('ID_ABOUT', $id)
        ->get()
        ->getRow();

    if (!$about) {

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Enregistrement introuvable'
        ]);
    }

    if (!empty($about->IMAGE)) {

        $path = FCPATH.'uploads/about/'.$about->IMAGE;

        if (file_exists($path)) {
            unlink($path);
        }
    }

    $this->db->table('about')
        ->where('ID_ABOUT', $id)
        ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Suppression effectuée'
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
    return $this->db->table('video_home')
        ->countAllResults();
}
// =========================================================
// COUNT FILTERED
// =========================================================
private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM video_home
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}
}