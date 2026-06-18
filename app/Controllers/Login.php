<?php


namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('SUPERBAT_ID_USER')) {
            return redirect()->to(site_url('Acceuil'))
                ->with('message', '<div class="alert alert-success text-center">Connexion déjà active</div>');
        }

        return view('LoginView', [
            'title' => 'Login'
        ]);
    }

    public function do_login()
    {
        $username = $this->request->getPost('USERNAME');
        $password = $this->request->getPost('PASSWORD');

        $user = $this->model->getOne(
            'admin_user',
            ['USERNAME' => $username, 'STATUS' => 1]
        );

        if (!$user) {
            return redirect()->back()->with('message',
                '<div class="alert alert-danger">Utilisateur introuvable</div>'
            );
        }

        // ⚠️ recommandé : password_hash (mais je garde ton md5 pour migration)
        if ($user['PASSWORD'] !== md5($password)) {
            return redirect()->back()->with('message',
                '<div class="alert alert-danger">Mot de passe incorrect</div>'
            );
        }

        // PROFILS
        $profils = $this->model->getRequete("
            SELECT PROFIL_ID
            FROM admin_user_profil
            WHERE ID_USER = {$user['ID_USER']}
        ");

        $profilIds = array_column($profils, 'PROFIL_ID');

        // DROITS (OPTIMISÉ EN 1 SEULE REQUÊTE)
        $droits = $this->model->getRequete("
            SELECT DISTINCT ID_DROIT
            FROM config_profil_droit
            WHERE PROFIL_ID IN (" . implode(',', $profilIds ?: [0]) . ")
        ");

        $droitIds = array_column($droits, 'ID_DROIT');

        // SESSION CI4
        session()->set([
            'SUPERBAT_ID_USER'  => $user['ID_USER'],
            'SUPERBAT_NOM'      => $user['NOM'],
            'SUPERBAT_PRENOM'   => $user['PRENOM'],
            'SUPERBAT_USERNAME' => $user['USERNAME'],
            'SUPERBAT_PROFILS'  => $profilIds,
            'SUPERBAT_DROIT'    => array_unique($droitIds),
            'ID_EMPLOYE'        => $user['ID_EMPLOYE'] ?? null
        ]);

        return redirect()->to(site_url('formexample'))
            ->with('message', '<div class="alert alert-success">Connexion réussie</div>');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('backend'));
    }

    public function forgotPassword()
    {
        return view('App\Modules\Administration\Views\mot_de_passe_oublier');
    }
}