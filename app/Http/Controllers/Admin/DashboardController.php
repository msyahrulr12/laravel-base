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

        $menus = $this->menuService->getMyAllMenu($this->getUser());

        // write audit trail
        $activity = sprintf('%s (%s) accessing dashboard at %s', $this->getUser()->name, $this->getUser()->email, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view('pages.admin.index', [
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'totalMembers' => User::count(),
            // 'menus' => $menus->getData(),
        ]);
    }
}
