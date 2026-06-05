<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;


class Temoignage extends BaseController
{


    public function index()
    {
        $data['title'] = 'Liste de caracteritique';

        return view('App\Modules\Features\Views\TemoignageView', $data);
    }
public function getList(): mixed
{
    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;
    $var_search = str_replace("'", "\'", $var_search);

    $query_principal = "SELECT * FROM testimonials WHERE 1";

    $group = "";
    $critaire = "";

    // LIMIT
    $limit = 'LIMIT 0,1000';
    if ($_POST['length'] != -1) {
        $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }

    // ORDER
    $order_column = [
        'ID_TESTMONIAL',
        'NAME',
        'ROLE',
        'MESSAGE',
        'STATUT',
        'DATE_INSERTION',
        'ID_TESTMONIAL'
    ];

    if (isset($_POST['order'][0]['column'])) {

        $colIndex = $_POST['order'][0]['column'];

        $order_by = isset($order_column[$colIndex])
            ? ' ORDER BY ' . $order_column[$colIndex] . ' ' . $_POST['order'][0]['dir']
            : ' ORDER BY ID_TESTMONIAL DESC';

    } else {
        $order_by = ' ORDER BY ID_TESTMONIAL DESC';
    }

    // SEARCH
    $search = !empty($var_search)
        ? " AND (NAME LIKE '%$var_search%' 
            OR ROLE LIKE '%$var_search%' 
            OR MESSAGE LIKE '%$var_search%')"
        : "";

    $query_secondaire = $query_principal .' '. $search .' '. $group .' '. $order_by .' '. $limit;
    $query_filter     = $query_principal .' '. $search .' '. $group;

    $fetch_data = $this->model->datatable($query_secondaire);

    $data = [];
    $i = $_POST['start'] + 1;

    foreach ($fetch_data as $row) {

        $img = !empty($row->IMAGE_TESTIMONIAL)
            ? '<img src="'.base_url('uploads/testimonials/'.$row->IMAGE_TESTIMONIAL).'" width="50">'
            : '';

        $status = ($row->STATUT == 1)
            ? '<span class="badge bg-success">Actif</span>'
            : '<span class="badge bg-danger">Inactif</span>';

        $sub = [];
        $sub[] = $i++;
        $sub[] = $row->NAME;
        $sub[] = $row->ROLE;
        $sub[] = $row->MESSAGE;
        $sub[] = $img;
        $sub[] = $status;
        $sub[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

        $sub[] = '
        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                Actions
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" onclick="editTestimonial('.$row->ID_TESTMONIAL.')">Modifier</a>
                <a class="dropdown-item" onclick="deleteTestimonial('.$row->ID_TESTMONIAL.')">Supprimer</a>
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

public function save()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Requête non autorisée'
        ]);
    }

    $rules = [
        'NAME' => 'required|min_length[3]',
        'ROLE' => 'required|min_length[2]',
        'MESSAGE' => 'required|min_length[3]'
    ];

    if (!$this->validate($rules)) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $this->validator->getErrors()
        ]);
    }

    $id = $this->request->getPost('ID_TESTMONIAL');

    $db = \Config\Database::connect();
    $db->transBegin();

    try {

        $img = $this->request->getFile('IMAGE_TESTIMONIAL');
        $fileName = null;

        if ($img && $img->isValid() && !$img->hasMoved()) {

            $allowed = ['image/jpeg','image/png','image/jpg','image/webp'];

            if (!in_array($img->getMimeType(), $allowed)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Format image invalide'
                ]);
            }

            $fileName = $img->getRandomName();
            $img->move(FCPATH.'uploads/testimonials', $fileName);
        }

        $data = [
            'NAME' => $this->request->getPost('NAME'),
            'ROLE' => $this->request->getPost('ROLE'),
            'MESSAGE' => $this->request->getPost('MESSAGE'),
            'STATUT' => $this->request->getPost('STATUT')
        ];

        if ($fileName) {
            $data['IMAGE_TESTIMONIAL'] = $fileName;
        }

        $builder = $db->table('testimonials');

        if (!empty($id)) {

            $old = $builder->where('ID_TESTMONIAL', $id)->get()->getRow();

            if ($old && $fileName && !empty($old->IMAGE_TESTIMONIAL)) {
                $path = FCPATH.'uploads/testimonials/'.$old->IMAGE_TESTIMONIAL;
                if (file_exists($path)) unlink($path);
            }

            $builder->where('ID_TESTMONIAL', $id)->update($data);
            $message = "Témoignage modifié avec succès";

        } else {

            $data['DATE_INSERTION'] = date('Y-m-d H:i:s');
            $builder->insert($data);
            $message = "Témoignage ajouté avec succès";
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
    $data = $this->db->table('testimonials')
        ->where('ID_TESTMONIAL', $id)
        ->get()
        ->getRow();

    if (!$data) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Témoignage introuvable'
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
    $id = $this->request->getPost('ID_TESTMONIAL');

    $row = $this->db->table('testimonials')
        ->where('ID_TESTMONIAL', $id)
        ->get()
        ->getRow();

    if (!$row) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Introuvable'
        ]);
    }

    if (!empty($row->IMAGE_TESTIMONIAL)) {
        $path = FCPATH.'uploads/testimonials/'.$row->IMAGE_TESTIMONIAL;
        if (file_exists($path)) unlink($path);
    }

    $this->db->table('testimonials')
        ->where('ID_TESTMONIAL', $id)
        ->delete();

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Supprimé avec succès'
    ]);
}

private function countAll()
{
    return $this->db->table('testimonials')
        ->countAllResults();
}

private function countFiltered($search)
{
    $sql = "
        SELECT COUNT(*) AS total
        FROM testimonials
        WHERE 1=1
        $search
    ";

    return $this->db->query($sql)
        ->getRow()
        ->total;
}


}