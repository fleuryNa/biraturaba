<?php

namespace App\Modules\Blog\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LoggerInterface;

class Blog extends BaseController
{
    public function index()
    {
        return view('blog/index', [
            'title'   => 'Blog module',
            'message' => 'Hello from App\\Modules\\Blog',
        ]);
    }

    public function post(string $slug = 'welcome')
    {
        return view('blog/post', [
            'title'   => 'Blog post',
            'slug'    => $slug,
            'content' => 'This is the content for the blog post "' . esc($slug) . '".',
        ]);
    }

    public function clearCache()
    {
        $dir = WRITEPATH . 'cache';
        $deleted = 0;

        if (is_dir($dir)) {
            $it = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS),
                \RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($it as $file) {
                $path = $file->getPathname();
                if (basename($path) === 'index.html') {
                    continue;
                }

                if ($file->isDir()) {
                    @rmdir($path);
                } else {
                    if (@unlink($path)) {
                        $deleted++;
                    }
                }
            }
        }

        return $this->response->setBody('Cleared ' . $deleted . ' cache files');
    }
}
