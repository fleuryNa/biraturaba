<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class UploadController extends BaseController
{
    public function getImage($filename = null)
    {
        if (empty($filename)) {
            return $this->response->setStatusCode(404);
        }

        $path = WRITEPATH . 'uploads/' . $filename;
        
        if (!file_exists($path)) {
            return $this->response->setStatusCode(404);
        }

        $file = new File($path);
        $mime = $file->getMimeType();
        
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setBody(file_get_contents($path));
    }
}