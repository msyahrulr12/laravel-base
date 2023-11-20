<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\MenuService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.dashboards.';
    private $baseView = 'pages.admin.dashboard.';
    private $title = 'Dashboard';
    private $permission = 'dashboard';
    private $menuService;

    public function __construct(
        MenuService $menuService
    )
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $this->checkPermission('home '.$this->permission);

        $menus = $this->menuService->getMyAllMenu(Auth::user());

        return view('pages.admin.index', [
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'totalMembers' => User::count(),
            // 'menus' => $menus->getData(),
        ]);
    }
}
