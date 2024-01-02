<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Service\AuditTrailService;
use App\Service\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends BaseController
{
    private $menuService;
    private $auditTrailService;

    public function __construct(
        MenuService $menuService,
        AuditTrailService $auditTrailService
    )
    {
        $this->menuService = $menuService;
        $this->auditTrailService = $auditTrailService;
    }

    public function login()
    {
        return view('pages.admin.login');
    }

    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // set user to status logged in
            $user = Auth::user();
            $user->is_logged_in = true;
            $user->save();

            // save menu to session
            $myMenu = $this->menuService->getMyAllMenu($user);
            session()->put(sprintf('my_menu_%d', $user->id), $myMenu->getData());

            // save activity to audit trails
            $activity = sprintf('%s (%s) logged in to application at %s', $user->name, $user->email, date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $user->name);

            return redirect()->route('admin.dashboard');
        }

        // save activity to audit trails
        $activity = sprintf('%s failed logged in to application at %s', $request->get('email'), date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $request->get('email'));

        Alert::error('Login Gagal', 'Email atau password salah!');
        return back();
    }

    public function logout(Request $request)
    {
        // set is_logged_in to false
        $user = Auth::user();
        $user->is_logged_in = false;
        $user->save();

        // save activity to audit trails
        $activity = sprintf('%s (%s) logged out from application at %s', $user->name, $user->email, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $user->name);

        Auth::logout();
        return redirect()->route('admin.login');
    }
}
