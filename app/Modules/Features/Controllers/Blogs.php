<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;


class Blogs extends BaseController
{


    public function index()
    {
        $data['title'] = 'Liste de caracteritique';

        return view('App\Modules\Features\Views\BlogsView', $data);
    }

public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    // =========================
    // TABLE BLOGS
    // =========================
    $query_principal = "SELECT * FROM blogs WHERE 1";

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
        'ID_BLOG',
        'TITLE',
        'IMAGE_BLOG',
        'CONTENT',
        'CATEGORIE_BLOG',
        'AUTHOR',
        'DATE_INSERTION',
        'ID_BLOG'
    ];

    if (isset($_POST['order'][0]['column']) && isset($_POST['order'][0]['dir'])) {

        $colIndex = $_POST['order'][0]['column'];

        $order_by = isset($order_column[$colIndex])
            ? ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir']
            : ' ORDER BY ID_BLOG DESC';

    } else {
        $order_by = ' ORDER BY ID_BLOG DESC';
    }

    // =========================
    // SEARCH
    // =========================
    $search = !empty($var_search)
        ? " AND (
            TITLE LIKE '%$var_search%' 
            OR CONTENT LIKE '%$var_search%' 
            OR CATEGORIE_BLOG LIKE '%$var_search%' 
            OR AUTHOR LIKE '%$var_search%'
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
        $img = !empty($row->IMAGE_BLOG)
            ? '<img src="' . base_url('uploads/blogs/' . $row->IMAGE_BLOG) . '" width="60">'
            : '';

        // CONTENT SHORT
        $content = strlen($row->CONTENT) > 60
            ? substr($row->CONTENT, 0, 60) . '...'
            : $row->CONTENT;

        $sub = [];
        $sub[] = $i++;
        $sub[] = $row->TITLE;
        $sub[] = $img;
        $sub[] = $content;
        $sub[] = $row->CATEGORIE_BLOG;
        $sub[] = $row->AUTHOR;
        $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

        $sub[] = '
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-cogs"></i> Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="editBlog(' . $row->ID_BLOG . ')">
                    <i class="fa fa-edit"></i> Modifier
                </a>
                <a class="dropdown-item" onclick="deleteBlog(' . $row->ID_BLOG . ')">
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
        'TITLE' => 'required|min_length[3]',
        'CONTENT' => 'required|min_length[3]',
        'CATEGORIE_BLOG' => 'required',
        'AUTHOR' => 'required'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Validation error',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_BLOG');
    $db = \Config\Database::connect();
    $db->transBegin();

    try {

        $fileName = null;
        $img = $this->request->getFile('IMAGE_BLOG');

        if ($img && $img->isValid() && !$img->hasMoved()) {

            $allowed = ['image/jpeg','image/png','image/jpg','image/webp'];

            if (!in_array($img->getMimeType(), $allowed)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Image invalide'
                ]);
            }

            $fileName = $img->getRandomName();
            $img->move(FCPATH.'uploads/blogs', $fileName);
        }

        $data = [
            'TITLE' => $this->request->getPost('TITLE'),
            'CONTENT' => $this->request->getPost('CONTENT'),
            'CATEGORIE_BLOG' => $this->request->getPost('CATEGORIE_BLOG'),
            'AUTHOR' => $this->request->getPost('AUTHOR')
        ];

        if ($fileName) {
            $data['IMAGE_BLOG'] = $fileName;
        }

        $builder = $db->table('blogs');

        if (!empty($id)) {

            $old = $builder->where('ID_BLOG', $id)->get()->getRow();

            if ($old && $fileName && !empty($old->IMAGE_BLOG)) {
                $path = FCPATH.'uploads/blogs/'.$old->IMAGE_BLOG;
                if (file_exists($path)) unlink($path);
            }

            $builder->where('ID_BLOG', $id)->update($data);
            $message = "Blog modifié";

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');
            $builder->insert($data);
            $message = "Blog ajouté";
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

    $data = $db->table('blogs')
        ->where('ID_BLOG', $id)
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
    $id = $this->request->getPost('ID_BLOG');

    $db = \Config\Database::connect();

    $old = $db->table('blogs')
        ->where('ID_BLOG', $id)
        ->get()
        ->getRow();

    if ($old && !empty($old->IMAGE_BLOG)) {
        $path = FCPATH.'uploads/blogs/'.$old->IMAGE_BLOG;
        if (file_exists($path)) unlink($path);
    }

    $db->table('blogs')->where('ID_BLOG', $id)->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Blog supprimé'
    ]);
}

private function countAll()
{
    return $this->db->table('blogs')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM blogs
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}