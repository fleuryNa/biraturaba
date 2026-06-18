<?php

namespace App\Controllers;

class Documentation extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Notre Documentation';
        
        $data['blogs'] =$this->model->getRequete("SELECT p.*FROM blogs p
        GROUP BY p.ID_BLOG LIMIT 3");
        $data['partenaires'] =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
        return view('site/DocumentationView',$data);
    }


    public function detail($id)
{
    $blog = $this->model->getRequeteOne("
        SELECT *
        FROM blogs
        WHERE ID_BLOG = $id
    ");

    if (empty($blog)) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Article introuvable');
    }

    // Articles récents
    $recentBlogs = $this->model->getRequete("
        SELECT ID_BLOG,TITLE,IMAGE_BLOG,DATE_INSERTION
        FROM blogs
        WHERE ID_BLOG != $id
        ORDER BY DATE_INSERTION DESC
        LIMIT 5
    ");
 $partenaires =$this->model->getRequete("SELECT p.*FROM partners p
        GROUP BY p.ID_PARTNERS ");
    return view('BlogDetailView', [
        'title'       => 'Detail de '.$blog['TITLE'],
        'blog'        => $blog,
        'recentBlogs' => $recentBlogs,
        'partenaires'=>$partenaires
    ]);
}


}