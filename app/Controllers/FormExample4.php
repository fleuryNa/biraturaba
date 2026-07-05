<?php

namespace App\Controllers;

use App\Models\MembreModel;
use App\Models\ProvinceModel;
use App\Models\CommuneModel;
use App\Models\ZoneModel;
use App\Models\CollineModel;
use App\Models\TypeGroupeModel;

class FormExample extends BaseController
{
    protected $membreModel;
    protected $typeGroupeModel;

    public function __construct()
    {
        helper('form');
        $this->membreModel = new MembreModel();
        $this->typeGroupeModel = new TypeGroupeModel();
    }

    // List all membres
    public function index()
    {
        $db = \Config\Database::connect();
        
        $membres = $db->table('membres_inscrits m')
            ->select('m.ID_MEMBRES, m.DESCRIPTION, c.COMMUNE_NAME, z.ZONE_NAME, col.COLLINE_NAME, m.NB_MEMBRE_INSCRITS, m.NOMBRE_HOMME, m.NOMBRE_FEMME, m.NB_GROUPE, m.ID_TYPE_GROUPE, tg.DESC_GROUPE as TYPE_GROUPE')
            ->join('collines col', 'col.COLLINE_ID = m.COLLINE_ID', 'left')
            ->join('zones z', 'z.ZONE_ID = col.ZONE_ID', 'left')
            ->join('communes c', 'c.COMMUNE_ID = z.COMMUNE_ID', 'left')
            ->join('type_groupes tg', 'tg.ID_TYPE_GROUPE = m.ID_TYPE_GROUPE', 'left')
            ->orderBy('m.ID_MEMBRES', 'DESC')
            ->get()
            ->getResultArray();

        return view('formexample/list', ['membres' => $membres]);
    }

    public function exportCsv()
    {
        $db = \Config\Database::connect();
        $membres = $db->table('membres_inscrits m')
            ->select('c.COMMUNE_NAME, z.ZONE_NAME, col.COLLINE_NAME, m.DESCRIPTION, m.NB_MEMBRE_INSCRITS, m.NOMBRE_HOMME, m.NOMBRE_FEMME, m.NB_GROUPE, tg.DESC_GROUPE as TYPE_GROUPE')
            ->join('collines col', 'col.COLLINE_ID = m.COLLINE_ID', 'left')
            ->join('zones z', 'z.ZONE_ID = col.ZONE_ID', 'left')
            ->join('communes c', 'c.COMMUNE_ID = z.COMMUNE_ID', 'left')
            ->join('type_groupes tg', 'tg.ID_TYPE_GROUPE = m.ID_TYPE_GROUPE', 'left')
            ->orderBy('m.ID_MEMBRES', 'DESC')
            ->get()
            ->getResultArray();

        $filename = 'membres_inscrits_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['Commune', 'Zone', 'Colline', 'Description', 'Membres inscrits', 'Hommes', 'Femmes', 'Structures', 'Type de groupe']);

        foreach ($membres as $membre) {
            fputcsv($csv, [
                $membre['COMMUNE_NAME'] ?? '',
                $membre['ZONE_NAME'] ?? '',
                $membre['COLLINE_NAME'] ?? '',
                $membre['DESCRIPTION'] ?? '',
                $membre['NB_MEMBRE_INSCRITS'],
                $membre['NOMBRE_HOMME'],
                $membre['NOMBRE_FEMME'],
                $membre['NB_GROUPE'],
                $membre['TYPE_GROUPE'] ?? '',
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
        
        $typeGroupes = $this->typeGroupeModel->findAll();

        return view('formexample/create', [
            'provinces' => $provinces,
            'typeGroupes' => $typeGroupes
        ]);
    }

    // Store new membre
    public function store()
    {
        $rules = [
            'province_id' => 'required|integer',
            'commune_id'  => 'required|integer',
            'zone_id'     => 'required|integer',
            'colline_id'  => 'required|integer',
            'description' => 'required|string|min_length[10]',
            'nb_membre_inscrits'     => 'required|integer',
            'nombre_homme'           => 'required|integer',
            'nombre_femme'           => 'required|integer',
            'nb_groupe'              => 'required|integer',
            'id_type_groupe'         => 'required|integer',
        ];

        $messages = [
            'province_id' => [
                'required' => 'La province est obligatoire.',
                'integer'  => 'La province doit être un nombre valide.'
            ],
            'commune_id' => [
                'required' => 'La commune est obligatoire.',
                'integer'  => 'La commune doit être un nombre valide.'
            ],
            'zone_id' => [
                'required' => 'La zone est obligatoire.',
                'integer'  => 'La zone doit être un nombre valide.'
            ],
            'colline_id' => [
                'required' => 'La colline est obligatoire.',
                'integer'  => 'La colline doit être un nombre valide.'
            ],
            'description' => [
                'required'    => 'La description est obligatoire.',
                'string'      => 'La description doit être un texte valide.',
                'min_length'  => 'La description doit contenir au moins 10 caractères.'
            ],
            'nb_membre_inscrits' => [
                'required' => 'Le nombre de membres inscrits est obligatoire.',
                'integer'  => 'Le nombre de membres inscrits doit être un nombre valide.'
            ],
            'nombre_homme' => [
                'required' => 'Le nombre d\'hommes est obligatoire.',
                'integer'  => 'Le nombre d\'hommes doit être un nombre valide.'
            ],
            'nombre_femme' => [
                'required' => 'Le nombre de femmes est obligatoire.',
                'integer'  => 'Le nombre de femmes doit être un nombre valide.'
            ],
            'nb_groupe' => [
                'required' => 'Le nombre de structures est obligatoire.',
                'integer'  => 'Le nombre de structures doit être un nombre valide.'
            ],
            'id_type_groupe' => [
                'required' => 'Le type de groupe est obligatoire.',
                'integer'  => 'Le type de groupe doit être un nombre valide.'
            ]
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validation personnalisée : vérifier que hommes + femmes = membres inscrits
        $nombre_homme = (int)$this->request->getPost('nombre_homme');
        $nombre_femme = (int)$this->request->getPost('nombre_femme');
        $nb_membre_inscrits = (int)$this->request->getPost('nb_membre_inscrits');

        if (($nombre_homme + $nombre_femme) != $nb_membre_inscrits) {
            return redirect()->back()
                ->withInput()
                ->with('errors', [
                    'somme' => 'La somme du nombre d\'hommes et de femmes (' . ($nombre_homme + $nombre_femme) . ') doit être égale au nombre total de membres inscrits (' . $nb_membre_inscrits . ').'
                ]);
        }

        $data = [
            'COLLINE_ID' => $this->request->getPost('colline_id'),
            'DESCRIPTION' => $this->request->getPost('description'),
            'NB_MEMBRE_INSCRITS' => $nb_membre_inscrits,
            'NOMBRE_HOMME' => $nombre_homme,
            'NOMBRE_FEMME' => $nombre_femme,
            'NB_GROUPE' => $this->request->getPost('nb_groupe'),
            'ID_TYPE_GROUPE' => $this->request->getPost('id_type_groupe'),
        ];

        $this->membreModel->insert($data);

        return redirect()->to('/formexample')->with('success', 'Membre créé avec succès');
    }

    // Show edit form
    public function edit($id = null)
    {
        $membre = $this->membreModel->find($id);
        if (! $membre) {
            return redirect()->to('/formexample')->with('error', 'Membre non trouvé');
        }

        $provinceModel = new ProvinceModel();
        $communeModel = new CommuneModel();
        $zoneModel = new ZoneModel();
        $collineModel = new CollineModel();

        $provinces = $provinceModel->findAll();
        $typeGroupes = $this->typeGroupeModel->findAll();
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

        return view('formexample/edit', compact('membre','provinces','communes','zones','collines','typeGroupes'));
    }

    // Update membre
    public function update($id = null)
    {
        $rules = [
            'province_id' => 'required|integer',
            'commune_id'  => 'required|integer',
            'zone_id'     => 'required|integer',
            'colline_id'  => 'required|integer',
            'description' => 'required|string|min_length[10]',
            'nb_membre_inscrits'     => 'required|integer',
            'nombre_homme'           => 'required|integer',
            'nombre_femme'           => 'required|integer',
            'nb_groupe'              => 'required|integer',
            'id_type_groupe'         => 'required|integer',
        ];

        $messages = [
            'province_id' => [
                'required' => 'La province est obligatoire.',
                'integer'  => 'La province doit être un nombre valide.'
            ],
            'commune_id' => [
                'required' => 'La commune est obligatoire.',
                'integer'  => 'La commune doit être un nombre valide.'
            ],
            'zone_id' => [
                'required' => 'La zone est obligatoire.',
                'integer'  => 'La zone doit être un nombre valide.'
            ],
            'colline_id' => [
                'required' => 'La colline est obligatoire.',
                'integer'  => 'La colline doit être un nombre valide.'
            ],
            'description' => [
                'required'    => 'La description est obligatoire.',
                'string'      => 'La description doit être un texte valide.',
                'min_length'  => 'La description doit contenir au moins 10 caractères.'
            ],
            'nb_membre_inscrits' => [
                'required' => 'Le nombre de membres inscrits est obligatoire.',
                'integer'  => 'Le nombre de membres inscrits doit être un nombre valide.'
            ],
            'nombre_homme' => [
                'required' => 'Le nombre d\'hommes est obligatoire.',
                'integer'  => 'Le nombre d\'hommes doit être un nombre valide.'
            ],
            'nombre_femme' => [
                'required' => 'Le nombre de femmes est obligatoire.',
                'integer'  => 'Le nombre de femmes doit être un nombre valide.'
            ],
            'nb_groupe' => [
                'required' => 'Le nombre de structures est obligatoire.',
                'integer'  => 'Le nombre de structures doit être un nombre valide.'
            ],
            'id_type_groupe' => [
    'required' => 'Le type de structures est obligatoire.',
    'integer'  => 'Le type de structures doit être un nombre valide.'
]
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validation personnalisée : vérifier que hommes + femmes = membres inscrits
        $nombre_homme = (int)$this->request->getPost('nombre_homme');
        $nombre_femme = (int)$this->request->getPost('nombre_femme');
        $nb_membre_inscrits = (int)$this->request->getPost('nb_membre_inscrits');

        if (($nombre_homme + $nombre_femme) != $nb_membre_inscrits) {
            return redirect()->back()
                ->withInput()
                ->with('errors', [
                    'somme' => 'La somme du nombre d\'hommes et de femmes (' . ($nombre_homme + $nombre_femme) . ') doit être égale au nombre total de membres inscrits (' . $nb_membre_inscrits . ').'
                ]);
        }

        $data = [
            'COLLINE_ID' => $this->request->getPost('colline_id'),
            'DESCRIPTION' => $this->request->getPost('description'),
            'NB_MEMBRE_INSCRITS' => $nb_membre_inscrits,
            'NOMBRE_HOMME' => $nombre_homme,
            'NOMBRE_FEMME' => $nombre_femme,
            'NB_GROUPE' => $this->request->getPost('nb_groupe'),
            'ID_TYPE_GROUPE' => $this->request->getPost('id_type_groupe'),
        ];

        $this->membreModel->update($id, $data);

        return redirect()->to('/formexample')->with('success', 'Membre mis à jour avec succès');
    }

    // Delete membre
    public function delete($id = null)
    {
        if ($id) {
            $this->membreModel->delete($id);
            return redirect()->to('/formexample')->with('success', 'Membre supprimé avec succès');
        }

        return redirect()->to('/formexample')->with('error', 'ID invalide');
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
    
    public function getTypeGroupes()
    {
        $typeGroupes = $this->typeGroupeModel->findAll();
        return $this->response->setJSON($typeGroupes);
    }
}