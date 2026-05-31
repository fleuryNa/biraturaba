<?php

namespace App\Modules\Blog\Config;

use CodeIgniter\Router\RouteCollection;

$routes->group('blog', static function (RouteCollection $routes) {
    $routes->get('', '\\App\Modules\Blog\Controllers\Blog::index');
    $routes->get('post/(:segment)', '\\App\Modules\Blog\Controllers\Blog::post/$1');
});
