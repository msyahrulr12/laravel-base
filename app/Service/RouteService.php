<?php

namespace App\Service;

use Illuminate\Support\Facades\Route;

class RouteService
{
    public static function getAllRoute()
    {
        $routeCollection = Route::getRoutes();
        $data = [];

        foreach ($routeCollection as $value) {
            if (strpos($value->uri, 'admin') !== false) {
                $data[] = sprintf('%s/%s', env('APP_URL', 'http://localhost:8000'), $value->uri);
            }
        }

        return $data;
    }
}
