<?php

namespace App\Modules\administration\Controllers;

use App\Controllers\BaseController;

class AdministrationUser extends BaseController
{
    public function index()
    {
        return view('App\Modules\administration\Views\AdministrationUserView', [
            'title' => 'Utilisateurs',
        ]);
    }

    public function getList()
    {
        $search = $this->request->getPost('search')['value'] ?? '';
        $start  = (int) ($this->request->getPost('start') ?? 0);
        $length = (int) ($this->request->getPost('length') ?? 10);
        $draw   = (int) ($this->request->getPost('draw') ?? 1);

        $builder = $this->db->table('admin_user au');
        $builder->select('au.ID_USER, au.NOM, au.PRENOM, au.USERNAME, ag.DESCRIPTION AS AGENCE, au.STATUS');
        $builder->join('masque_agence_msi ag', 'ag.ID_AGENCE = au.ID_AGENCE', 'left');

        if ($search !== '') {
            $builder->groupStart();
            $builder->like('au.NOM', $search);
            $builder->orLike('au.PRENOM', $search);
            $builder->orLike('au.USERNAME', $search);
            $builder->orLike('ag.DESCRIPTION', $search);
            $builder->groupEnd();
        }

        $total = $builder->countAllResults(false);

        $orderIndex = (int) ($this->request->getPost('order')[0]['column'] ?? 0);
        $orderDir   = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $columns    = ['au.ID_USER', 'au.NOM', 'au.PRENOM', 'au.USERNAME', 'ag.DESCRIPTION', 'au.STATUS'];
        $orderField = $columns[$orderIndex] ?? 'au.ID_USER';

        $builder->orderBy($orderField, $orderDir);
        $builder->limit($length, $start);

        $rows = $builder->get()->getResult();

        $data = [];
        foreach ($rows as $row) {
            $profiles = $this->db->query('SELECT cp.DESCRIPTION FROM admin_user_profil aup JOIN config_profil cp ON cp.PROFIL_ID = aup.PROFIL_ID WHERE aup.ID_USER = ' . (int) $row->ID_USER . ' ORDER BY cp.DESCRIPTION')->getResultArray();
            $profileHtml = '<ul class="mb-0 ps-3">';
            foreach ($profiles as $profile) {
                $profileHtml .= '<li>' . esc($profile['DESCRIPTION']) . '</li>';
            }
            $profileHtml .= '</ul>';

            $status = $row->STATUS == 1
                ? '<span class="badge bg-success">Actif</span>'
                : '<span class="badge bg-secondary">Inactif</span>';

            $data[] = [
                esc($row->NOM . ' ' . $row->PRENOM),
                esc($row->USERNAME),
                esc($row->AGENCE),
                $profileHtml,
                $status,
                '<button class="btn btn-sm btn-outline-primary">Gérer</button>',
            ];
        }

        return $this->response->setJSON([
            'draw' => $draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }
}
