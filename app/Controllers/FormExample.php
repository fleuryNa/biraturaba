<?php

namespace App\Controllers;

use App\Models\MembreModel;
use App\Models\ProvinceModel;
use App\Models\CommuneModel;
use App\Models\ZoneModel;
use App\Models\CollineModel;

class FormExample extends BaseController
{
    protected $membreModel;

    public function __construct()
    {
        helper('form');
        $this->membreModel = new MembreModel();
    }

    // List all membres
    public function index()
    {
        $db = \Config\Database::connect();
        
        $membres = $db->table('membres_inscrits m')
            ->select('m.ID_MEMBRES, c.COMMUNE_NAME, z.ZONE_NAME, col.COLLINE_NAME, m.NB_GROUPE_FONCTIONNELS, m.NB_MEMBRE_INSCRITS, m.NOMBRE_HOMME, m.NOMBRE_FEMME')
            ->join('collines col', 'col.COLLINE_ID = m.COLLINE_ID', 'left')
            ->join('zones z', 'z.ZONE_ID = col.ZONE_ID', 'left')
            ->join('communes c', 'c.COMMUNE_ID = z.COMMUNE_ID', 'left')
            ->orderBy('m.ID_MEMBRES', 'DESC')
            ->get()
            ->getResultArray();

        return view('formexample/list', ['membres' => $membres]);
    }

    public function exportCsv()
    {
        $db = \Config\Database::connect();
        $membres = $db->table('membres_inscrits m')
            ->select('c.COMMUNE_NAME, z.ZONE_NAME, col.COLLINE_NAME, m.NB_GROUPE_FONCTIONNELS, m.NB_MEMBRE_INSCRITS, m.NOMBRE_HOMME, m.NOMBRE_FEMME')
            ->join('collines col', 'col.COLLINE_ID = m.COLLINE_ID', 'left')
            ->join('zones z', 'z.ZONE_ID = col.ZONE_ID', 'left')
            ->join('communes c', 'c.COMMUNE_ID = z.COMMUNE_ID', 'left')
            ->orderBy('m.ID_MEMBRES', 'DESC')
            ->get()
            ->getResultArray();

        $filename = 'membres_inscrits_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['Commune', 'Zone', 'Colline', 'Groupes fonctionnels', 'Membres inscrits', 'Hommes', 'Femmes']);

        foreach ($membres as $membre) {
            fputcsv($csv, [
                $membre['COMMUNE_NAME'] ?? '',
                $membre['ZONE_NAME'] ?? '',
                $membre['COLLINE_NAME'] ?? '',
                $membre['NB_GROUPE_FONCTIONNELS'],
                $membre['NB_MEMBRE_INSCRITS'],
                $membre['NOMBRE_HOMME'],
                $membre['NOMBRE_FEMME'],
            ]);
        }

        rewind($csv);
        $content = stream_get_contents($csv);
        fclose($csv);

        return $this->response->setBody($content)->setStatusCode(200)->setHeader($headers);
    }

    // Show create form
    public function create()
    {
        $provinceModel = new ProvinceModel();
        $provinces = $provinceModel->findAll();

        return view('formexample/create', ['provinces' => $provinces]);
    }

    // Store new membre
    public function store()
    {
        $rules = [
            'province_id' => 'required|integer',
            'commune_id'  => 'required|integer',
            'zone_id'     => 'required|integer',
            'colline_id'  => 'required|integer',
            'nb_groupe_fonctionnels' => 'required|integer',
            'nb_membre_inscrits'     => 'required|integer',
            'nombre_homme'           => 'required|integer',
            'nombre_femme'           => 'required|integer',
            'nb_groupe'              => 'required|integer',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'COLLINE_ID' => $this->request->getPost('colline_id'),
            'NB_GROUPE_FONCTIONNELS' => $this->request->getPost('nb_groupe_fonctionnels'),
            'NB_MEMBRE_INSCRITS' => $this->request->getPost('nb_membre_inscrits'),
            'NOMBRE_HOMME' => $this->request->getPost('nombre_homme'),
            'NOMBRE_FEMME' => $this->request->getPost('nombre_femme'),
            'NB_GROUPE' => $this->request->getPost('nb_groupe'),
        ];

        $this->membreModel->insert($data);

        return redirect()->to('/formexample')->with('success', 'Membre created successfully');
    }

    // Show edit form
    public function edit($id = null)
    {
        $membre = $this->membreModel->find($id);
        if (! $membre) {
            return redirect()->to('/formexample')->with('error', 'Membre not found');
        }

        $provinceModel = new ProvinceModel();
        $communeModel = new CommuneModel();
        $zoneModel = new ZoneModel();
        $collineModel = new CollineModel();

        $provinces = $provinceModel->findAll();
        $communes = [];
        $zones = [];
        $collines = [];

        if (! empty($membre['COLLINE_ID'])) {
            $currentColline = $collineModel->find($membre['COLLINE_ID']);
            if ($currentColline) {
                $currentZone = $zoneModel->find($currentColline['ZONE_ID']);
                if ($currentZone) {
                    $currentCommune = $communeModel->find($currentZone['COMMUNE_ID']);
                    if ($currentCommune) {
                        $membre['province_id'] = $currentCommune['PROVINCE_ID'];
                        $membre['commune_id'] = $currentZone['COMMUNE_ID'];
                        $membre['zone_id'] = $currentZone['ZONE_ID'];

                        $communes = $communeModel->where('PROVINCE_ID', $currentCommune['PROVINCE_ID'])->findAll();
                        $zones = $zoneModel->where('COMMUNE_ID', $currentZone['COMMUNE_ID'])->findAll();
                        $collines = $collineModel->where('ZONE_ID', $currentZone['ZONE_ID'])->findAll();
                    }
                }
            }
        }

        return view('formexample/edit', compact('membre','provinces','communes','zones','collines'));
    }

    // Update membre
    public function update($id = null)
    {
        $rules = [
            'province_id' => 'required|integer',
            'commune_id'  => 'required|integer',
            'zone_id'     => 'required|integer',
            'colline_id'  => 'required|integer',
            'nb_groupe_fonctionnels' => 'required|integer',
            'nb_membre_inscrits'     => 'required|integer',
            'nombre_homme'           => 'required|integer',
            'nombre_femme'           => 'required|integer',
            'nb_groupe'              => 'required|integer',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'COLLINE_ID' => $this->request->getPost('colline_id'),
            'NB_GROUPE_FONCTIONNELS' => $this->request->getPost('nb_groupe_fonctionnels'),
            'NB_MEMBRE_INSCRITS' => $this->request->getPost('nb_membre_inscrits'),
            'NOMBRE_HOMME' => $this->request->getPost('nombre_homme'),
            'NOMBRE_FEMME' => $this->request->getPost('nombre_femme'),
            'NB_GROUPE' => $this->request->getPost('nb_groupe'),
        ];

        $this->membreModel->update($id, $data);

        return redirect()->to('/formexample')->with('success', 'Membre updated successfully');
    }

    // Delete membre
    public function delete($id = null)
    {
        if ($id) {
            $this->membreModel->delete($id);
            return redirect()->to('/formexample')->with('success', 'Membre deleted');
        }

        return redirect()->to('/formexample')->with('error', 'Invalid ID');
    }

    // AJAX endpoints to support cascading selects
    public function getCommunes($provinceId = null)
    {
        $communeModel = new CommuneModel();
        $communes = $communeModel->where('PROVINCE_ID', $provinceId)->findAll();
        return $this->response->setJSON($communes);
    }

    public function getZones($communeId = null)
    {
        $zoneModel = new ZoneModel();
        $zones = $zoneModel->where('COMMUNE_ID', $communeId)->findAll();
        return $this->response->setJSON($zones);
    }

    public function getCollines($zoneId = null)
    {
        $collineModel = new CollineModel();
        $collines = $collineModel->where('ZONE_ID', $zoneId)->findAll();
        return $this->response->setJSON($collines);
    }
}
 