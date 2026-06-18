<?php

namespace App\Modules\administration\Controllers;

use App\Controllers\BaseController;

class AdministrationProfil extends BaseController
{
    public function index()
    {
        return view('App\Modules\administration\Views\AdministrationProfilView', [
            'title' => 'Profils & Droits',
        ]);
    }

    public function getList()
    {
        $search = $this->request->getPost('search')['value'] ?? '';
        $start  = (int) ($this->request->getPost('start') ?? 0);
        $length = (int) ($this->request->getPost('length') ?? 10);
        $draw   = (int) ($this->request->getPost('draw') ?? 1);

        $builder = $this->db->table('config_profil cp');
        $builder->select('cp.PROFIL_ID, cp.DESCRIPTION, COUNT(cpd.ID_DROIT) AS NUMBER');
        $builder->join('config_profil_droit cpd', 'cpd.PROFIL_ID = cp.PROFIL_ID', 'left');
        $builder->groupBy('cp.PROFIL_ID, cp.DESCRIPTION');

        if ($search !== '') {
            $builder->like('cp.DESCRIPTION', $search);
        }

        $total = $builder->countAllResults(false);

        $orderIndex = (int) ($this->request->getPost('order')[0]['column'] ?? 0);
        $orderDir   = $this->request->getPost('order')[0]['dir'] ?? 'asc';
        $columns    = ['cp.PROFIL_ID', 'cp.DESCRIPTION', 'NUMBER'];
        $orderField = $columns[$orderIndex] ?? 'cp.PROFIL_ID';

        $builder->orderBy($orderField, $orderDir);
        $builder->limit($length, $start);

        $rows = $builder->get()->getResult();

        $data = [];
        foreach ($rows as $row) {
            $data[] = [
                esc($row->DESCRIPTION),
                (int) $row->NUMBER,
                '<button class="btn btn-sm btn-outline-primary">Voir</button>',
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