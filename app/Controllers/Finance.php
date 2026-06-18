<?php

namespace App\Controllers;

class Finance extends BaseController
{

 protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index(): string
    {
        $data['title'] = 'Les Finances';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/FinanceView',$data);
    }


    public function financeByYear()
{
    $sql = "
        SELECT
            ANNEE_DE_PRESSION,
            SUM(MONTANT) AS TOTAL
        FROM finances
        GROUP BY ANNEE_DE_PRESSION
        ORDER BY ANNEE_DE_PRESSION
    ";

    $result = $this->db->query($sql)->getResult();

    $categories = [];
    $series = [];

    foreach ($result as $row) {

        $categories[] = $row->ANNEE_DE_PRESSION;

        $series[] = (float)$row->TOTAL;
    }

    return $this->response->setJSON([
        'categories' => $categories,
        'series' => $series
    ]);
}


public function financeByType()
{
    $sql = "
        SELECT
            tf.DESCRIPTION_TYPE,
            SUM(f.MONTANT) AS TOTAL
        FROM finances f
        INNER JOIN type_finance tf
            ON tf.TYPE_FINANCE_ID = f.TYPE_FINANCE_ID
        GROUP BY tf.TYPE_FINANCE_ID, tf.DESCRIPTION_TYPE
    ";

    $result = $this->db->query($sql)->getResult();

    $data = [];

    foreach ($result as $row) {
        $data[] = [
            'name' => $row->DESCRIPTION_TYPE,
            'y' => (float) $row->TOTAL
        ];
    }

    return $this->response->setJSON($data);
}


}