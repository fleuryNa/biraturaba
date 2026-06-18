<?php

namespace App\Modules\Administration\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

	public function index()
	{

		// print_r('expression');exit();
		$data['title']="Liste de Utilisateurs";
		 return view('App\Modules\Administration\Views\UserListView', $data);
	}


	public function listing()
{
    $post = $this->request->getPost();

    $query_principal = "
        SELECT
            ID_USER,
            NOM,
            PRENOM,
            USERNAME,
            masque_agence_msi.DESCRIPTION AS AGENCE,
            admin_user.STATUS AS STATUS
        FROM admin_user
        LEFT JOIN masque_agence_msi
        ON masque_agence_msi.ID_AGENCE = admin_user.ID_AGENCE
    ";

    $var_search = !empty($post['search']['value'])
        ? $this->db->escapeLikeString($post['search']['value'])
        : null;

    $limit = 'LIMIT 0,10';

    if (isset($post['length']) && $post['length'] != -1) {

        $limit = 'LIMIT ' .
        ($post['start'] ?? 0) .
        ',' .
        $post['length'];
    }

    $order_column = [
        'ID_USER',
        'NOM',
        'PRENOM',
        'USERNAME',
        'config_profil.DESCRIPTION',
        'masque_agence_msi.DESCRIPTION',
        'admin_user.STATUS'
    ];

    $order_by = isset($post['order'])
    ? ' ORDER BY '.$order_column[$post['order'][0]['column']]
    .' '.$post['order'][0]['dir']
    : ' ORDER BY ID_USER ASC';

    $search = '';

    if (!empty($post['search']['value'])) {

        $search = "
        AND (
            NOM LIKE '%{$var_search}%'
            OR PRENOM LIKE '%{$var_search}%'
            OR USERNAME LIKE '%{$var_search}%'
            OR masque_agence_msi.DESCRIPTION LIKE '%{$var_search}%'
        )";
    }

    $query_secondaire = $query_principal
    .' '.$search
    .' '.$order_by
    .' '.$limit;

    $query_filter = $query_principal.' '.$search;

    $resultat = $this->model->datatable($query_secondaire);

    $data = [];

    foreach ($resultat as $key) {

        $row = [];

        $profils = $this->model->getRequete(
            "SELECT
            admin_user_profil.PROFIL_ID,
            config_profil.DESCRIPTION
            FROM admin_user_profil
            JOIN config_profil
            ON admin_user_profil.PROFIL_ID=config_profil.PROFIL_ID
            WHERE admin_user_profil.ID_USER=".$key->ID_USER."
            ORDER BY config_profil.DESCRIPTION"
        );

        $resdroit = "<table class='table'>";

        foreach ($profils as $value) {

            $resdroit .= "<tr>
            <td>".$value['DESCRIPTION']."</td>
            </tr>";
        }

        $resdroit .= "</table>";

        if ($key->STATUS == 1) {

            $stat = 'Actif';
            $fx = 'desactiver';
            $col = 'btn-danger';
            $titr = 'Désactiver';
			$stitr = 'voulez-vous désactiver cet utilisateur ';
			$bigtitr = 'Désactivation de cet utilisateur';
            $icone = '<i class="fa fa-lock"></i>';
        } else {

            $stat = 'Inactif';
            $fx = 'reactiver';
            $col = 'btn-primary';
            $titr = 'Réactiver';
			$stitr = 'voulez-vous réactiver cet  utilisateur';
			$bigtitr = 'Réactivation de cet  utilisateur';
            $icone = '<i class="fa fa-unlock"></i>';
        }

        $row[] = $key->NOM.' '.$key->PRENOM;
        $row[] = $key->USERNAME;
        $row[] = $key->AGENCE;

        $row[] = "
        <a class='btn btn-primary btn-xs'
           href='#'
           data-toggle='modal'
           data-target='#rendreeff{$key->ID_USER}'>
           <i class='fa fa-eye'></i>
        </a>";

        $row[] = $stat;

        $row[] = '
<div class="modal fade" id="rendreeff'.$key->ID_USER.'" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Profils</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                '.$resdroit.'
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Fermer
                </button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="desactcat'.$key->ID_USER.'" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">'.$bigtitr.'</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <h6>
                    <b>Mr/Mme,</b>
                    '.$stitr.' ('.$key->NOM.' '.$key->PRENOM.')
                </h6>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Annuler
                </button>

                <a href="'.site_url("administration/user/".$fx."/".$key->ID_USER).'"
                   class="btn '.$col.'">
                    '.$titr.'
                </a>
            </div>

        </div>
    </div>
</div>

<div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-cogs"></i> Actions
    </button>

    <div class="dropdown-menu">

        <a class="dropdown-item"
           href="'.site_url("administration/user/index_update/".$key->ID_USER).'">
            <i class="fa fa-edit"></i> Modifier
        </a>

        <a class="dropdown-item"
           href="#"
           data-toggle="modal"
           data-target="#desactcat'.$key->ID_USER.'">
            '.$icone.' '.$titr.'
        </a>

    </div>
</div>
';
        $data[] = $row;
    }

    $output = [
        "draw" => intval($post['draw']),
        "recordsTotal" => $this->model->all_data($query_principal),
        "recordsFiltered" => $this->model->all_data($query_filter),
        "data" => $data
    ];

    return $this->response->setJSON($output);
}

public function ajouter()
{
    helper(['form']);

    $data = [
        'title'      => 'Utilisateur',
        'profil'     => $this->model->getRequete("SELECT * FROM config_profil ORDER BY DESCRIPTION"),
        'agence'     => $this->model->getRequete("SELECT * FROM masque_agence_msi ORDER BY DESCRIPTION"),
        'validation' => \Config\Services::validation()
    ];

    return view('App\Modules\Administration\Views\UserAddView', $data);
}



	public function add()
{
    helper(['form']);

    $rules = [
        'NOM'       => 'required|min_length[2]',
        'PRENOM'    => 'required|min_length[2]',
        'USERNAME'  => 'required|is_unique[admin_user.USERNAME]',
        'PASSWORD'  => 'required|min_length[4]',
        'PROFIL_ID' => 'required'
    ];

    if (!$this->validate($rules)) {

        $data['title'] = 'Utilisateur';

        $data['profil'] = $this->Model->getRequete(
            "SELECT * FROM config_profil ORDER BY DESCRIPTION"
        );

        $data['agence'] = $this->Model->getRequete(
            "SELECT * FROM masque_agence_msi ORDER BY DESCRIPTION"
        );

         return view('App\Modules\Administration\Views\UserAddView', $data);
    }

    $db = \Config\Database::connect();
    $db->transStart(); // 🔥 sécurité transaction

    $dataUser = [
        'NOM'       => $this->request->getPost('NOM'),
        'PRENOM'    => $this->request->getPost('PRENOM'),
        'USERNAME'  => $this->request->getPost('USERNAME'),
        'PASSWORD'  => password_hash($this->request->getPost('PASSWORD'), PASSWORD_DEFAULT),
        'ID_AGENCE' => 1,
        'STATUS'    => 1
    ];

    // 🔥 INSERT USER
    $db->table('admin_user')->insert($dataUser);

    $id_user = $db->insertID();

    // 🔥 INSERT PROFILS
    $profils = $this->request->getPost('PROFIL_ID');

    if (!empty($profils)) {
        foreach ($profils as $profil) {

            $db->table('admin_user_profil')->insert([
                'ID_USER'   => $id_user,
                'PROFIL_ID' => $profil
            ]);
        }
    }

    $db->transComplete();

    if ($db->transStatus() === false) {

        return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement');
    }

    return redirect()->to(site_url('administration/user'))
                     ->with('message', 'Utilisateur enregistré avec succès');
}

	public function check_username_unique(string $username): bool
{
    $db = \Config\Database::connect();

    $exists = $db->table('admin_user')
        ->where('USERNAME', $username)
        ->countAllResults();

    if ($exists > 0) {

        $this->validator->setError(
            'USERNAME',
            'Ce nom d’utilisateur existe déjà.'
        );

        return false;
    }

    return true;
}

public function index_update($id)
{
    $db = \Config\Database::connect();

    $id = (int) $id; // 🔥 sécurité

    // USER
    $data['data'] = $db->table('admin_user')
        ->where('ID_USER', $id)
        ->get()
        ->getRowArray();

    // PROFILS
    $data['profil'] = $db->table('config_profil')
        ->orderBy('DESCRIPTION', 'ASC')
        ->get()
        ->getResultArray();

    // AGENCES
    $data['agence'] = $db->table('masque_agence_msi')
        ->orderBy('DESCRIPTION', 'ASC')
        ->get()
        ->getResultArray();

    // PROFILS USER
    $profils_user = $db->table('admin_user_profil')
        ->select('PROFIL_ID')
        ->where('ID_USER', $id)
        ->get()
        ->getResultArray();

    $data['profils_user'] = array_column($profils_user, 'PROFIL_ID');

    $data['title'] = 'Utilisateur';

    return view('App\Modules\Administration\Views\UserUpdateView', $data);
}
	public function update()
{
    $db = \Config\Database::connect();
    helper(['form']);

    $ID_USER = (int) $this->request->getPost('ID_USER');

    $rules = [
        'NOM'      => 'required|min_length[2]',
        'PRENOM'   => 'required|min_length[2]',
        'USERNAME' => 'required|valid_email'
    ];

    if (!$this->validate($rules)) {

        $data['title'] = 'Utilisateur';

        $data['data'] = $db->table('admin_user')
            ->where('ID_USER', $ID_USER)
            ->get()
            ->getRowArray();

        $data['profil'] = $db->table('config_profil')
            ->orderBy('DESCRIPTION', 'ASC')
            ->get()
            ->getResultArray();

        $profils_user = $db->table('admin_user_profil')
            ->select('PROFIL_ID')
            ->where('ID_USER', $ID_USER)
            ->get()
            ->getResultArray();

        $data['profils_user'] = array_column($profils_user, 'PROFIL_ID');

        return view('User_Update_View', $data);
    }

    $db->transStart(); // 🔥 sécurité transaction

    // ======================
    // UPDATE USER
    // ======================
    $dataUser = [
        'NOM'       => $this->request->getPost('NOM'),
        'PRENOM'    => $this->request->getPost('PRENOM'),
        'USERNAME'  => $this->request->getPost('USERNAME'),
        'ID_AGENCE' => 1
    ];

    $db->table('admin_user')
        ->where('ID_USER', $ID_USER)
        ->update($dataUser);

    // ======================
    // PROFILS
    // ======================
    $profils = $this->request->getPost('PROFIL_ID');

    // supprimer anciens profils
    $db->table('admin_user_profil')
        ->where('ID_USER', $ID_USER)
        ->delete();

    // insérer nouveaux profils
    if (!empty($profils)) {
        foreach ($profils as $profil) {
            $db->table('admin_user_profil')->insert([
                'ID_USER'   => $ID_USER,
                'PROFIL_ID' => $profil
            ]);
        }
    }

    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->back()
            ->with('error', 'Erreur lors de la modification');
    }

    return redirect()->to(site_url('administration/user'))
        ->with('message', 'Utilisateur modifié avec succès');
}




public function desactiver($id)
{
    $db = \Config\Database::connect();

    $id = (int) $id;

    $db->table('admin_user')
        ->where('ID_USER', $id)
        ->update(['STATUS' => 0]);

    return redirect()->to(site_url('administration/user'))
        ->with('message', "Utilisateur désactivé avec succès");
}


public function reactiver($id)
{
    $db = \Config\Database::connect();

    $id = (int) $id;

    $db->table('admin_user')
        ->where('ID_USER', $id)
        ->update(['STATUS' => 1]);

    return redirect()->to(site_url('administration/user'))
        ->with('message', "Utilisateur réactivé avec succès");
}
// function countActiveSessions()
// {
// 	$path = sys_get_temp_dir();
// 	$files = glob($path . '/ci_session*');

// 	$nb_sessions = 0;
//     $expiration = 7200; // même valeur que dans config

//     foreach ($files as $file) {
//         // vérifier si la session n'est pas expirée
//     	if (filemtime($file) + $expiration > time()) {
//     		$nb_sessions++;
//     	}
//     }

//     echo "Utilisateurs connectés : " . $nb_sessions;
// }


// public function getConnectedUsersStats()
// {
// 	$path = sys_get_temp_dir();
// 	$files = glob($path . '/ci_session*');

// 	$users = [];
// 	$sessions = 0;

// 	foreach ($files as $file) {

// 		$content = file_get_contents($file);

//         // vérifier si session valide
// 		if (strpos($content, 'SUPERBAT_ID_USER') !== false) {
//             $sessions++; // chaque fichier = une machine/session

//             // extraire ID utilisateur
//             if (preg_match('/SUPERBAT_ID_USER\|i:(\d+);/', $content, $matches)) {
//             	$users[] = $matches[1];
//             }
//         }
//     }

//     // return [
//     //     'total_machines' => $sessions,
//     //     'total_users' => count(array_unique($users))
//     // ];

//     echo "Utilisateurs connectés : " . $sessions . " (".count(array_unique($users))." utilisateurs uniques)";
// }






}