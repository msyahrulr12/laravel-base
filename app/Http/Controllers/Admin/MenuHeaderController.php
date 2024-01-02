<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuHeaderRequest;
use App\Service\MenuHeaderService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class MenuHeaderController extends BaseController
{
    private $baseRoute = 'admin.menu_headers.';
    private $baseView = 'pages.admin.menu_header.';
    private $title = 'Menu Header';
    private $permission = 'menu_headers';
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
    private $menuHeaderService;

    public function __construct(MenuHeaderService $menuHeaderService)
    {
        $this->menuHeaderService = $menuHeaderService;
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
        $result = $this->menuHeaderService->getAll($perPage);

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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MenuHeaderRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuHeaderRequest $request)
    {
        $this->checkPermission('create '.$this->permission);

        $result = $this->menuHeaderService->create($request);
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

        $result = $this->menuHeaderService->find($id);

        return view($this->commonView.'show', [
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

        $result = $this->menuHeaderService->find($id);

        // write audit trail
        $activity = sprintf('%s (%s) opening form edit %s with ID %d at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'edit', [
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

        $result = $this->menuHeaderService->update($request, $id);

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

        $result = $this->menuHeaderService->delete($id);
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

        Alert::error('Gagal update data!', $message);
        return back();
    }
}
