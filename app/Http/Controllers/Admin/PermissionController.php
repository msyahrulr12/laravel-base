<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PermissionRequest;
use App\Service\PermissionService;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $this->checkPermission('list '.$this->permission);

        $perPage = $request->get('per_page') ?? 10;
        $result = $this->permissionService->getAll($perPage);

        // write audit trail
        $activity = sprintf('%s (%s) list %s at %s', $this->getUser()->name, $this->getUser()->email, $this->title, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'index', [
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

        // write audit trail
        $activity = sprintf('%s (%s) opening form create %s at %s', $this->getUser()->name, $this->getUser()->email, $this->title, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'create', [
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
            // write audit trail
            $activity = sprintf('%s (%s) creating %s with data success \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, json_encode($result->getData()), date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);

            Alert::success('Buat Data Berhasil', 'Berhasil membuat data  baru');
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

        $data = $this->model->findOrFail($id);

        // write audit trail
        $activity = sprintf('%s (%s) opening form edit %s with ID %d at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'edit', [
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
