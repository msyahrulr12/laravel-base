<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Service\MenuService;
use App\Service\RoleService;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

use function Ramsey\Uuid\v1;

class RoleController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.roles.';
    private $baseView = 'pages.admin.role.';
    private $title = 'Role';
    private $permission = 'roles';
    private $columns = [
        'name' => 'Nama',
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

    public function __construct(Role $model, RoleService $roleService, MenuService $menuService)
    {
        $this->model = $model;
        $this->roleService = $roleService;
        $this->menuService = $menuService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission('list '.$this->permission);

        $datas = $this->model->orderBy('id', 'desc')->get();
        return view($this->baseView.'index', [
            'datas' => $datas,
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

        $permissions = Permission::orderBy('name', 'asc')->get();
        $menuHeader = $this->menuService->getAll();

        return view($this->baseView.'create', [
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'permissions' => $permissions,
            'menu_headers' => $menuHeader->getData(),
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

        unset($data['permission_ids']);

        $result = $this->model->create($data)->syncPermissions($permissionIds);

        if ($result) {
            Alert::success('Buat Data Berhasil', 'Berhasil membuat data  baru');
            return redirect()->route($this->baseRoute.'index');
        }

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
        return view($this->baseView.'show', [
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

        return view($this->baseView.'edit', [
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

        $data = $this->model->findOrFail($id);
        $data->syncPermissions($permissionIds);

        $findRole = $this->roleService->find($id);

        $role = $findRole->getData();
        $result = $data->update($request->all());
        $role->menu()->sync($menuIds);

        if ($result) {
            Alert::success('Edit Data Berhasil', 'Berhasil mengubah data ');
            return redirect()->route($this->baseRoute.'index');
        }

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

        $data = $this->model->findOrFail($id);
        $result = $data->delete();
        if ($result) {
            Alert::success('Hapus Data Berhasil', 'Berhasil menghapus data');
            // return $this->index();
            return redirect()->route($this->baseRoute.'index');
        }

        Alert::error('Terjadi Kesalahan!', 'Gagal menghapus data');
        return back();
    }
}
