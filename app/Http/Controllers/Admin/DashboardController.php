<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.dashboards.';
    private $baseView = 'pages.admin.dashboard.';
    private $title = 'Dashboard';
    private $permission = 'dashboard';

    public function index()
    {
        $this->checkPermission('home '.$this->permission);
        return view('pages.admin.index', [
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
        ]);
    }
}
