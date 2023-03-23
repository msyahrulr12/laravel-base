<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CardMember;
use App\Models\Documentation;
use App\Models\Region;
use App\Models\User;
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
            'totalMembers' => User::count(),
            'totalRegions' => Region::count(),
            'totalCards' => CardMember::count(),
            'totalDocumentations' => Documentation::count(),
        ]);
    }
}
