<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;


class Features extends BaseController
{


    public function index()
    {
        $data['title'] = 'Liste de caracteritique';

        return view('App\Modules\Features\Views\FeaturesView', $data);
    }


    public function getList(): mixed
    {
        $var_search = $_POST['search']['value'] ?? '';
        $var_search = addslashes($var_search);

    // ✅ QUERY PRINCIPALE CORRIGÉE (features)
        $query_principal = "SELECT 
        ID_FEATURE,
        TITLE,
        DESC_FEATURE,
        ICON_FEATURE,
        STATUS,
        DATE_INSERTION
        FROM features WHERE 1=1";

        $group = "";
        $critaire = "";

    // Pagination
        $limit = "LIMIT 0,1000";
        if ($_POST['length'] != -1) {
            $limit = "LIMIT " . $_POST["start"] . "," . $_POST["length"];
        }

    // Order columns adaptées à features
        $order_column = [
            0 => 'ID_FEATURE',
            1 => 'TITLE',
            2 => 'DESC_FEATURE',
            3 => 'STATUS',
            4 => 'DATE_INSERTION'
        ];

        $order_by = " ORDER BY ID_FEATURE DESC";

        if (isset($_POST['order'])) {
            $colIndex = $_POST['order'][0]['column'];
            $dir = $_POST['order'][0]['dir'];

            if (isset($order_column[$colIndex])) {
                $order_by = "ORDER BY " . $order_column[$colIndex] . " " . $dir;
            }
        }

    // Search adapté features
        $search = "";
        if (!empty($var_search)) {
            $search = " AND (
            TITLE LIKE '%$var_search%' 
            OR DESC_FEATURE LIKE '%$var_search%'
            OR STATUS LIKE '%$var_search%'
        )";
    }

    $query_secondaire = $query_principal . $search . $group . $order_by . " " . $limit;
    $query_filter     = $query_principal . $search . $group;

    $fetch_data = $this->model->datatable($query_secondaire);

    $data = [];
    $i = $_POST['start'] + 1;

    foreach ($fetch_data as $row) {

        // image icon
        $icon = '<img src="' . base_url('uploads/features/' . $row->ICON_FEATURE) . '" width="40" height="40">';

        $sub_array = [];

        $sub_array[] = $i++;
        $sub_array[] = $row->TITLE;
        $sub_array[] = $row->DESC_FEATURE;
        $sub_array[] = $icon;

        $sub_array[] = ($row->STATUS == 1)
        ? '<span class="badge bg-success">Actif</span>'
        : '<span class="badge bg-danger">Inactif</span>';

        $sub_array[] = date('d/m/Y', strtotime($row->DATE_INSERTION));

        $sub_array[] = '
        <div class="btn-group">
        <button class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
        Action
        </button>
        <ul class="dropdown-menu">
        <li>
        <a class="dropdown-item" href="#" onclick="editFeature(' . $row->ID_FEATURE . ')">
        Modifier
        </a>
        </li>
        <li>
        <a class="dropdown-item text-danger" href="#" onclick="deleteFeature(' . $row->ID_FEATURE . ')">
        Supprimer
        </a>
        </li>
        </ul>
        </div>';

        $data[] = $sub_array;
    }

    return $this->response->setJSON([
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $this->model->all_data($query_principal),
        "recordsFiltered" => $this->model->all_data($query_filter),
        "data" => $data,
    ]);
}
    // Formulaire ajout
public function create()
{
    return view('feature/create');
}

    // Enregistrer
public function store()
{
    $this->featureModel->save([
        'TITLE'        => $this->request->getPost('TITLE'),
        'DESC_FEATURE' => $this->request->getPost('DESC_FEATURE'),
        'ICON_FEATURE' => $this->request->getPost('ICON_FEATURE'),
        'STATUS'       => $this->request->getPost('STATUS')
    ]);

    return redirect()->to('/feature');
}

    // Formulaire modification
public function edit($id)
{
    $data['feature'] = $this->featureModel->find($id);

    return view('feature/edit', $data);
}

    // Mise à jour
public function update($id)
{
    $this->featureModel->update($id, [
        'TITLE'        => $this->request->getPost('TITLE'),
        'DESC_FEATURE' => $this->request->getPost('DESC_FEATURE'),
        'ICON_FEATURE' => $this->request->getPost('ICON_FEATURE'),
        'STATUS'       => $this->request->getPost('STATUS')
    ]);

    return redirect()->to('/feature');
}

    // Suppression
public function delete($id)
{
    $this->featureModel->delete($id);

    return redirect()->to('/feature');
}
}