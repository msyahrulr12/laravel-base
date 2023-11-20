<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuHeaderRequest;
use App\Http\Requests\MenuRequest;
use App\Service\MenuHeaderService;
use App\Service\MenuService;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class MenuController extends BaseController
{
    private $baseRoute = 'admin.menus.';
    private $baseView = 'pages.admin.menu.';
    private $title = 'Menu';
    private $permission = 'menus';
    private $columns = [
        'code' => [
            'title' => 'Kode',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
        'name' => [
            'title' => 'Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
        'parent' => [
            'title' => 'Menu Utama',
            'type' => self::TYPE_BELONGS_TO,
            'show' => false,
            'trim' => false
        ],
        'menu_header' => [
            'title' => 'Menu Header',
            'type' => self::TYPE_BELONGS_TO,
            'show' => false,
            'trim' => false
        ],
        'description' => [
            'title' => 'Deskripsi',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
        'created_by' => [
            'title' => 'Dibuat Oleh',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
        'updated_by' => [
            'title' => 'Terakhir Diupdate Oleh',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
    ];
    private $menuService;
    private $menuHeaderService;

    public function __construct(MenuService $menuService, MenuHeaderService $menuHeaderService)
    {
        $this->menuService = $menuService;
        $this->menuHeaderService = $menuHeaderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkPermission('list '.$this->permission);

        $result = $this->menuService->getAll();

        return view($this->baseView.'index', [
            'datas' => $result->getData(),
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
        $parentMenu = $this->menuService->getParentMenu();
        $menuHeaders = $this->menuHeaderService->getAll();

        return view($this->baseView.'create', [
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'permissions' => $permissions,
            'menus' => $parentMenu->getData(),
            'menu_headers' => $menuHeaders->getData(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MenuRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $this->checkPermission('create '.$this->permission);

        $result = $this->menuService->create($request);

        if (count($result->getErrors()) < 1) {
            Alert::success('Buat Data Berhasil', 'Berhasil membuat data  baru');
            return redirect()->route($this->baseRoute.'index');
        }

        $errors = $result->getErrors();
        $messageErrors = array_map(function($r) {
            return $r->getMessage();
        }, $errors);
        $message = implode(', ', $messageErrors);

        Alert::error('Gagal membuat data baru!', $message);
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

        $result = $this->menuService->find($id);

        return view($this->baseView.'show', [
            'data' => $result->getData(),
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'columns' => $this->columns,
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

        $result = $this->menuService->find($id);

        return view($this->baseView.'edit', [
            'data' => $result->getData(),
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MenuHeaderRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuHeaderRequest $request, $id)
    {
        $this->checkPermission('update '.$this->permission);

        $result = $this->menuService->update($request, $id);

        if (count($result->getErrors()) < 1) {
            Alert::success('Edit Data Berhasil', 'Berhasil mengubah data ');
            return redirect()->route($this->baseRoute.'index');
        }

        $errors = $result->getErrors();
        $messageErrors = array_map(function($r) {
            return $r->getMessage();
        }, $errors);
        $message = implode(', ', $messageErrors);

        Alert::error('Gagal update data!', $message);
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

        $result = $this->menuService->delete($id);
        if (count($result->getErrors()) < 1) {
            Alert::success('Hapus Data Berhasil', 'Berhasil menghapus data');
            // return $this->index();
            return redirect()->route($this->baseRoute.'index');
        }

        $errors = $result->getErrors();
        $messageErrors = array_map(function($r) {
            return $r->getMessage();
        }, $errors);
        $message = implode(', ', $messageErrors);

        Alert::error('Gagal update data!', $message);
        return back();
    }
}
