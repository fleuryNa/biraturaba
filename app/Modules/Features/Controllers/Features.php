<?php

namespace App\Modules\Features\Controllers;

use App\Controllers\BaseController;


class Features extends BaseController
{


    public function index()
    {
        $data['title'] = 'Liste de caracteritique';

        return view('features_view', $data);
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