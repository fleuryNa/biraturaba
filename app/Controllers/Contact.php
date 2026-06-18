<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Contact';
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/ContactView',$data);
    }


    public function save()
{
    $db = db_connect();

    $data = [
        'NAME_CONTACT'   => $this->request->getPost('name'),
        'EMAIL'          => $this->request->getPost('email'),
        'SUBJECT'        => $this->request->getPost('subject'),
        'MESSAGE_CONTACT'=> $this->request->getPost('message'),
        'IS_READ'        => 0,
        'DATE_INSERTION' => date('Y-m-d H:i:s')
    ];

    $db->table('contacts')->insert($data);

    return $this->response->setJSON([
        'status' => true,
        'message' => 'Message envoyé avec succès'
    ]);
}


}