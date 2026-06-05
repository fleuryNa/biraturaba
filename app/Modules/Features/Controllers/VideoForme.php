<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;

class VideoForme extends BaseController
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
        return view('App\Modules\Features\Views\VideoFormView');
    }

    // =========================================================
    // DATATABLE LISTE PROJETS
    // ========================================================

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    // =========================
    // TABLE VIDEO_HOME
    // =========================
    $query_principal = "SELECT * FROM video_home WHERE 1";

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
        'ID_VIDEO',
        'TITRE',
        'URL_VIDEO',
        'IMAGE_FOND',
        'STATUT',
        'ID_VIDEO'
    ];

    if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

        $colIndex = $_POST['order'][0]['column'];

        if (isset($order_column[$colIndex])) {
            $order_by = ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir'];
        } else {
            $order_by = ' ORDER BY ID_VIDEO DESC';
        }

    } else {
        $order_by = ' ORDER BY ID_VIDEO DESC';
    }

    // =========================
    // SEARCH
    // =========================
    $search = !empty($var_search)
        ? " AND (
            TITRE LIKE '%$var_search%'
            OR URL_VIDEO LIKE '%$var_search%'
        )"
        : "";

    // =========================
    // QUERY FINAL
    // =========================
    $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group . ' ' . $order_by . ' ' . $limit;

    $query_filter = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $group;

    $fetch_data = $this->model->datatable($query_secondaire);

    $data = [];
    $i = $_POST['start'] + 1;

    foreach ($fetch_data as $row) {

        // IMAGE BACKGROUND
        $image = !empty($row->IMAGE_FOND)
            ? '<img src="' . base_url('uploads/video/' . $row->IMAGE_FOND) . '" width="60" height="40" style="object-fit:cover;">'
            : '';

        // STATUS
        $status = $row->STATUT == 1
            ? '<span class="badge bg-success">Actif</span>'
            : '<span class="badge bg-danger">Inactif</span>';

        $sub = [];
        $sub[] = $i++;
        $sub[] = $row->TITRE;
        $sub[] = '<a href="' . $row->URL_VIDEO . '" target="_blank">Voir vidéo</a>';
        $sub[] = $image;
        $sub[] = $status;

        $sub[] = '
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cogs"></i> Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="editVideo(' . $row->ID_VIDEO . ')">
                    <i class="fa fa-edit"></i> Modifier
                </a>
                <a class="dropdown-item text-danger" onclick="deleteVideo(' . $row->ID_VIDEO . ')">
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
        'TITRE' => 'required|min_length[3]',
        'URL_VIDEO' => 'permit_empty|valid_url'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_VIDEO');

    $db = \Config\Database::connect();
    $db->transBegin();

    try {

        $image = $this->request->getFile('IMAGE_FOND');
        $fileName = null;

        // =========================
        // UPLOAD IMAGE
        // =========================
        if ($image && $image->isValid() && !$image->hasMoved()) {

            if (!in_array($image->getMimeType(), [
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

            $fileName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/video', $fileName);
        }

        // =========================
        // DATA
        // =========================
        $data = [
            'TITRE' => trim($this->request->getPost('TITRE')),
            'URL_VIDEO' => trim($this->request->getPost('URL_VIDEO')),
            'STATUT' => $this->request->getPost('STATUT')
        ];

        if ($fileName) {
            $data['IMAGE_FOND'] = $fileName;
        }

        $builder = $db->table('video_home');

        // =========================
        // UPDATE
        // =========================
        if (!empty($id)) {

            $old = $builder->where('ID_VIDEO', $id)->get()->getRow();

            // supprimer ancienne image si nouvelle upload
            if ($old && $fileName && !empty($old->IMAGE_FOND)) {

                $oldPath = FCPATH . 'uploads/video/' . $old->IMAGE_FOND;

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            $builder->where('ID_VIDEO', $id)->update($data);
            $message = "Vidéo modifiée avec succès";

        } 
        // =========================
        // INSERT
        // =========================
        else {

            $builder->insert($data);
            $message = "Vidéo ajoutée avec succès";
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
    // =========================================================
    // GET ONE PROJET
    // =========================================================
// =========================================================
// GET ONE PARTNER
// =========================================================
public function getOne($id)
{
    $data = $this->db->table('video_home')
        ->where('ID_VIDEO', $id)
        ->get()
        ->getRow();

    if (!$data) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Vidéo introuvable'
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
    $id = $this->request->getPost('ID_VIDEO');

    if (empty($id)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'ID invalide'
        ]);
    }

    $db = \Config\Database::connect();

    $video = $db->table('video_home')
        ->where('ID_VIDEO', $id)
        ->get()
        ->getRow();

    if (!$video) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Vidéo introuvable'
        ]);
    }

    try {

        // =========================
        // SUPPRESSION IMAGE PHYSIQUE
        // =========================
        if (!empty($video->IMAGE_FOND)) {

            $path = FCPATH . 'uploads/video/' . $video->IMAGE_FOND;

            if (file_exists($path)) {
                unlink($path);
            }
        }

        // =========================
        // SUPPRESSION DB
        // =========================
        $db->table('video_home')
            ->where('ID_VIDEO', $id)
            ->delete();

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Vidéo supprimée avec succès'
        ]);

    } catch (\Throwable $e) {

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur serveur',
            'debug' => $e->getMessage()
        ]);
    }
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