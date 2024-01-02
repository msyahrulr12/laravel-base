<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Service\MenuService;
use App\Service\PermissionService;
use App\Service\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class RoleController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.roles.';
    private $baseView = 'pages.admin.role.';
    private $title = 'Role';
    private $permission = 'roles';
    private $columns = [
        'name' => [
            'title' => 'Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
    ];
    private $detailColumns = [
        'name' => [
            'title' => 'Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'permission' => [
            'title' => 'Permission',
            'type' => self::TYPE_MANY_TO_MANY,
            'show' => false,
            'trim' => true
        ],
    ];
    private $roleService;
    private $menuService;
    private $permissionService;

    public function __construct(
        Role $model,
        RoleService $roleService,
        MenuService $menuService,
        PermissionService $permissionService
    )
    {
        $this->model = $model;
        $this->roleService = $roleService;
        $this->menuService = $menuService;
        $this->permissionService = $permissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkPermission('list '.$this->permission);

        $perPage = $request->get('per_page') ?? 10;
        $datas = $this->roleService->getAll($perPage);

        // write audit trail
        $activity = sprintf('%s (%s) list %s at %s', $this->getUser()->name, $this->getUser()->email, $this->title, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'index', [
            'datas' => $datas->getData(),
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'columns' => $this->columns,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkPermission('create '.$this->permission);

        $permissions = $this->permissionService->getAll();
        $menuHeader = $this->menuService->getAll();
        $menu = $this->menuService->getAll();
        $menu = $this->menuService->getAll();
        $currentMenu = [];
        $currentPermissions = [];

        // write audit trail
        $activity = sprintf('%s (%s) opening form create %s at %s', $this->getUser()->name, $this->getUser()->email, $this->title, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'create', [
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'permissions' => $permissions->getData(),
            'menu_headers' => $menuHeader->getData(),
            'menu_data' => $menu->getData(),
            'current_menus' => $currentMenu,
            'current_permissions' => $currentPermissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->checkPermission('create '.$this->permission);

        $data = $request->all();
        $permissionIds = $data['permission_ids'];
        $menuIds = $data['menu_ids'];

        unset($data['permission_ids']);

        $result = $this->roleService->createBySpatie($request);
        if (count($result->getErrors()) < 1) {
            // write audit trail
            $activity = sprintf('%s (%s) creating %s with data success \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, json_encode($result->getData()), date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);

            $role = $result->getData();

            // sync role to menu
            $role->syncPermissions($permissionIds);

            // sync role to selected permission
            $roleData = $this->roleService->find($role->id);
            if (count($roleData->getErrors()) > 0) {
                // write audit trail
                $activity = sprintf('%s (%s) binding role to pemission failed because role with ID %d is not found at %s', $this->getUser()->name, $this->getUser()->email, $role->id, date('Y-m-d H:i:s'));
                $this->writeAuditTrail($activity, $this->getUser()->name);

                Alert::error('Terjadi Kesalahan!', 'Gagal menghubungkan role dengan permission');
                return redirect()->route($this->baseRoute.'index');
            }

            // sync role to permission
            $roleSpatie = $roleData->getData();
            $roleSpatie->menu()->sync($menuIds);
            // $roleSpatie->syncPermissions($permissionIds);

            Alert::success('Buat Data Berhasil', 'Berhasil membuat data baru');
            return redirect()->route($this->baseRoute.'index');
        }


        $errors = $result->getErrors();
        $messageErrors = array_map(function($r) {
            return $r->getMessage();
        }, $errors);
        $message = implode(', ', $messageErrors);

        // write audit trail
        $activity = sprintf('%s (%s) creating %s with data failed because \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $message, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        Alert::error('Gagal membuat data baru!', $message);
        return back();

        Alert::error('Terjadi Kesalahan!', 'Gagal membuat data baru');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkPermission('show '.$this->permission);

        $data = $this->roleService->find($id);

        // write audit trail
        $activity = sprintf('%s (%s) showing %s with ID %d at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'show', [
            'data' => $data->getData(),
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'columns' => $this->detailColumns,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->checkPermission('update '.$this->permission);

        $permissions = Permission::orderBy('name', 'asc')->get();

        $role = $this->roleService->find($id);
        $data = $role->getData();
        $currentPermissions = $data->permission->toArray();
        $menu = $this->menuService->getAll();
        $currentMenu = $data->menu->all();

        // write audit trail
        $activity = sprintf('%s (%s) opening form edit %s with ID %d at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'edit', [
            'data' => $data,
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'permissions' => $permissions,
            'current_permissions' => $currentPermissions,
            'menu_data' => $menu->getData(),
            'current_menus' => $currentMenu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $this->checkPermission('update '.$this->permission);

        $permissionIds = $request->request->get('permission_ids');
        $menuIds = $request->request->get('menu_ids');

        $findRoleSpatie = $this->roleService->findBySpatieModel($id);
        if (count($findRoleSpatie->getErrors()) > 0) {
            $errors = $findRoleSpatie->getErrors();
            $messageErrors = array_map(function($r) {
                return $r->getMessage();
            }, $errors);
            $message = implode(', ', $messageErrors);

            // write audit trail
            $activity = sprintf('%s (%s) updating %s with ID %d failed because %s at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, $message, date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);
        }
        $roleSpatie = $findRoleSpatie->getData();
        $roleSpatie->syncPermissions($permissionIds);

        $findRole = $this->roleService->find($id);
        if (count($findRole->getErrors()) > 0) {
            $errors = $findRole->getErrors();
            $messageErrors = array_map(function($r) {
                return $r->getMessage();
            }, $errors);
            $message = implode(', ', $messageErrors);

            // write audit trail
            $activity = sprintf('%s (%s) updating %s with ID %d failed because %s at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, $message, date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);
        }

        $role = $findRole->getData();
        $role->menu()->sync($menuIds);

        $result = $this->roleService->update($request, $id);
        if (count($result->getErrors()) < 1) {
            // write audit trail
            $activity = sprintf('%s (%s) updating %s with ID %d success at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);

            Alert::success('Edit Data Berhasil', 'Berhasil mengubah data ');
            return redirect()->route($this->baseRoute.'index');
        }

        $errors = $result->getErrors();
        $messageErrors = array_map(function($r) {
            return $r->getMessage();
        }, $errors);
        $message = implode(', ', $messageErrors);

        // write audit trail
        $activity = sprintf('%s (%s) updating %s with ID %d failed because \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, $message, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        Alert::error('Gagal update data!', $message);
        return back();

        Alert::error('Terjadi Kesalahan!', 'Gagal mengubah data');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->checkPermission('delete '.$this->permission);

        // $data = $this->model->findOrFail($id);
        $result = $this->roleService->delete($id);
        if (count($result->getErrors()) < 1) {
            // write audit trail
            $activity = sprintf('%s (%s) deleting %s with ID %d success at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);

            Alert::success('Hapus Data Berhasil', 'Berhasil menghapus data');
            return redirect()->route($this->baseRoute.'index');
        }

        $errors = $result->getErrors();
        $messageErrors = array_map(function($r) {
            return $r->getMessage();
        }, $errors);
        $message = implode(', ', $messageErrors);

        // write audit trail
        $activity = sprintf('%s (%s) deleting %s with ID %d failed because \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, $message, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        Alert::error('Terjadi Kesalahan!', 'Gagal menghapus data');
        return back();
    }
}
