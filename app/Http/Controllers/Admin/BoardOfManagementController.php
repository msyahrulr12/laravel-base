<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardOfManagementCreateRequest;
use App\Http\Requests\BoardOfManagementUpdateRequest;
use App\Models\BoardOfManagement;
use App\Service\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class BoardOfManagementController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.board_of_managements.';
    private $baseView = 'pages.admin.board_of_management.';
    private $title = 'Susunan Anggota';
    private $permission = 'board_of_managements';
    private $columns = [
        'code' => [
            'title' => 'Kode',
            'type' => self::TYPE_TEXT,
            'show' => true,
            'trim' => false
        ],
        'title' => [
            'title' => 'Judul',
            'type' => self::TYPE_TEXT,
            'show' => true,
            'trim' => false
        ],
        'image' => [
            'title' => 'Gambar',
            'type' => self::TYPE_IMAGE,
            'show' => true,
            'trim' => false
        ],
        'content' => [
            'title' => 'Konten',
            'type' => self::TYPE_TEXT,
            'show' => true,
            'trim' => true
        ],
    ];

    public function __construct(BoardOfManagement $model)
    {
        $this->model = $model;
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
     * Show the board_of_management for creating a new resource.
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardOfManagementCreateRequest $request)
    {
        $this->checkPermission('create '.$this->permission);
        $request->request->set('created_by', sprintf('%s (%s)', Auth::user()->name, Auth::user()->email));

        $uploadHelper = new UploadHelper($request->file('image'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('image', $fullname);

        $result = $this->model->create($request->request->all());
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

        $data = $this->model->findOrFail($id);
        return view($this->baseView.'show', [
            'data' => $data,
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'columns' => $this->columns,
        ]);
    }

    /**
     * Show the board_of_management for editing the specified resource.
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
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BoardOfManagementUpdateRequest $request, $id)
    {
        $this->checkPermission('update '.$this->permission);
        $request->request->set('updated_by', sprintf('%s (%s)', Auth::user()->name, Auth::user()->email));

        $data = $this->model->findOrFail($id);

        if ($request->file('image')) {
            $uploadHelper = new UploadHelper($request->file('image'));
            $uploadSuccess = $uploadHelper->upload($data->image);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('image', $fullname);
        }

        $result = $data->update($request->request->all());

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
