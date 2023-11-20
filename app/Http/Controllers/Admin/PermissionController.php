<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionRequest;
use App\Service\PermissionService;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

use function Ramsey\Uuid\v1;

class PermissionController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.permissions.';
    private $baseView = 'pages.admin.permission.';
    private $title = 'Permission';
    private $permission = 'permissions';
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
    ];
    private $permissionService;

    public function __construct(Permission $model, PermissionService $permissionService)
    {
        $this->model = $model;
        $this->permissionService = $permissionService;
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

        return view($this->baseView.'create', [
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'create' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $this->checkPermission('create '.$this->permission);

        $result = $this->permissionService->create($request);
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

        $data = $this->permissionService->find($id);
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

        $data = $this->model->findOrFail($id);
        return view($this->baseView.'edit', [
            'data' => $data,
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'create' => false,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $this->checkPermission('update '.$this->permission);

        $data = $this->model->findOrFail($id);
        $result = $this->permissionServiceupdate($request);

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
