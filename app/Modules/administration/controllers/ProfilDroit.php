<?php

namespace App\Modules\Administration\Controllers;

use App\Controllers\BaseController;
// use App\Models\BiraturabaModel;

class ProfilDroit extends BaseController
{
    protected $model;

    public function __construct()
    {
        // $this->model = new BiraturabaModel();
        helper(['form', 'url']);
    }

    // ================= LIST PAGE =================
    public function index()
    {
        return view('App\Modules\Administration\Views\ProfilDroitView', [
            'title' => 'Liste de Profils'
        ]);
    }

    // ================= DATATABLE =================
    public function listing()
    {
        $request = $this->request->getPost();

        $queryPrincipal = "
            SELECT config_profil.PROFIL_ID,
                   config_profil.DESCRIPTION,
                   COUNT(config_profil_droit.ID_DROIT) AS NUMBER
            FROM config_profil
            JOIN config_profil_droit
            ON config_profil_droit.PROFIL_ID = config_profil.PROFIL_ID
            GROUP BY config_profil.PROFIL_ID, config_profil.DESCRIPTION
        ";

        $searchValue = $request['search']['value'] ?? null;

        $search = '';
        if (!empty($searchValue)) {
            $searchValue = $this->db->escapeLikeString($searchValue);
            $search = "AND DESCRIPTION LIKE '%{$searchValue}%'";
        }

        $orderColumn = ['PROFIL_ID', 'DESCRIPTION'];

        $orderBy = isset($request['order'])
            ? "ORDER BY " . $orderColumn[$request['order'][0]['column']] . " " . $request['order'][0]['dir']
            : "ORDER BY PROFIL_ID ASC";

        $limit = "LIMIT 0,10";

        if (isset($request['length']) && $request['length'] != -1) {
            $limit = "LIMIT " . $request['start'] . "," . $request['length'];
        }

        $sql = $queryPrincipal . " " . $search . " " . $orderBy . " " . $limit;
        $sqlFilter = $queryPrincipal . " " . $search;

        $result = $this->model->datatable($sql);

        $data = [];

        foreach ($result as $row) {

            // DROITS
            $droits = $this->model->getRequete("
                SELECT config_droits.DESCRIPTION AS DROIT
                FROM config_profil_droit
                JOIN config_droits
                ON config_droits.ID_DROIT = config_profil_droit.ID_DROIT
                WHERE config_profil_droit.PROFIL_ID = {$row->PROFIL_ID}
            ");

            $html = "<table class='table'>";

            foreach ($droits as $d) {
                $html .= "<tr><td>{$d['DROIT']}</td></tr>";
            }

            $html .= "</table>";

            $data[] = [
                $row->DESCRIPTION,
                "<a class='btn btn-primary btn-xs' data-toggle='modal' data-target='#rendreeff{$row->PROFIL_ID}'>{$row->NUMBER}</a>",

                // ACTIONS + MODAL
                "
                <div class='modal fade' id='rendreeff{$row->PROFIL_ID}'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h4>{$row->DESCRIPTION}</h4>
                                <button class='close' data-dismiss='modal'>&times;</button>
                            </div>
                            <div class='modal-body'>{$html}</div>
                        </div>
                    </div>
                </div>
                

                <div class='btn-group'>
                    <button class='btn btn-primary dropdown-toggle' data-toggle='dropdown'>
                        Actions
                    </button>
                    <div class='dropdown-menu'>
                        <a class='dropdown-item' href='" . site_url('administration/profil-droit/update/' . $row->PROFIL_ID) . "'>Modifier</a>
                        <a class='dropdown-item' data-toggle='modal' data-target='#rendreeff{$row->PROFIL_ID}'>Voir</a>
                        <a class='dropdown-item' href='" . site_url('administration/profil-droit/suppression/' . $row->PROFIL_ID) . "' onclick='return confirm(\"Confirmer la suppression ?\")'>Supprimer</a>
                    </div>
                </div>
                "
            ];
        }

        return $this->response->setJSON([
            "draw" => intval($request['draw']),
            "recordsTotal" => $this->model->all_data($queryPrincipal),
            "recordsFiltered" => $this->model->all_data($sqlFilter),
            "data" => $data
        ]);
    }

    // ================= ADD FORM =================
    public function ajouter()
    {
        return view('App\Modules\Administration\Views\ProfilDroitAddView', [
            'title' => 'Profil & Droit',
            'droits' => $this->model->getRequete("SELECT * FROM config_droits ORDER BY DESCRIPTION")
        ]);
    }

    // ================= INSERT =================
    public function add()
    {
        $rules = [
            'DESCRIPTION' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Validation échouée');
        }

        $post = $this->request->getPost();

        // INSERT PROFIL
        $profilId = $this->model->insertLastId('config_profil', [
            'DESCRIPTION' => $post['DESCRIPTION']
        ]);

        // INSERT DROITS
        if (!empty($post['ID_DROIT'])) {
            foreach ($post['ID_DROIT'] as $id) {
                $this->model->create('config_profil_droit', [
                    'PROFIL_ID' => $profilId,
                    'ID_DROIT'  => $id
                ]);
            }
        }

        return redirect()->to('administration/profil-droit')
            ->with('success', 'Profil ajouté avec succès');
    }

    // ================= EDIT =================
public function index_update($id)
{
    // Sécuriser l'ID
    $id = (int) $id;

    // Profil
    $profil = $this->model->getRequeteOne(
        "SELECT * FROM config_profil WHERE PROFIL_ID = {$id}"
    );

    if (!$profil) {
        return redirect()->to(site_url('administration/profil-droit'))
            ->with('message', '<div class="alert alert-danger">Profil introuvable</div>');
    }

    // Tous les droits
    $droits = $this->model->getRequete(
        "SELECT * FROM config_droits ORDER BY DESCRIPTION"
    );

    // Droits déjà sélectionnés (IMPORTANT)
    $droits_selected = array_column(
        $this->model->getRequete(
            "SELECT ID_DROIT FROM config_profil_droit WHERE PROFIL_ID = {$id}"
        ),
        'ID_DROIT'
    );

    return view('App\Modules\Administration\Views\ProfilDroitUpdateView', [
        'title'            => 'Profil & Droit',
        'data'             => $profil,
        'droits'           => $droits,
        'droits_selected'  => $droits_selected
    ]);
}

    // ================= UPDATE =================
    public function update()
    {
        $post = $this->request->getPost();

        $this->model->updateData('config_profil',
            ['PROFIL_ID' => $post['PROFIL_ID']],
            ['DESCRIPTION' => $post['DESCRIPTION']]
        );

        $this->model->deleteData('config_profil_droit',
            ['PROFIL_ID' => $post['PROFIL_ID']]
        );

        if (!empty($post['ID_DROIT'])) {
            foreach ($post['ID_DROIT'] as $id) {
                $this->model->create('config_profil_droit', [
                    'PROFIL_ID' => $post['PROFIL_ID'],
                    'ID_DROIT'  => $id
                ]);
            }
        }

        return redirect()->to('administration/profil-droit')
            ->with('success', 'Profil modifié avec succès');
    }

    // ================= DELETE =================
    public function suppression($id)
    {
        $user = $this->model->getOne('admin_user', ['PROFIL_ID' => $id]);

        if ($user) {
            return redirect()->back()->with('error',
                'Impossible: profil déjà utilisé'
            );
        }

        $this->model->deleteData('config_profil_droit', ['PROFIL_ID' => $id]);
        $this->model->deleteData('config_profil', ['PROFIL_ID' => $id]);

        return redirect()->to('administration/profil-droit')
            ->with('success', 'Profil supprimé');
    }
}