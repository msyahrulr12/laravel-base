<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentationUpdateRequest;
use App\Http\Requests\DocumentationCreateRequest;
use App\Models\Documentation;
use App\Service\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class DocumentationController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.documentations.';
    private $baseView = 'pages.admin.documentation.';
    private $title = 'Dokumentasi';
    private $permission = 'documentations';
    private $columns = [
        'code' => [
            'title' => 'Kode',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'title' => [
            'title' => 'Judul',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'description' => [
            'title' => 'Deskripsi',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'file' => [
            'title' => 'File',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'filename' => [
            'title' => 'Nama File',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'file_type' => [
            'title' => 'Tipe File',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
    ];

    public function __construct(Documentation $model)
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
     * Show the documentation for creating a new resource.
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
    public function store(DocumentationCreateRequest $request)
    {
        $this->checkPermission('create '.$this->permission);
        $request->request->set('created_by', sprintf('%s (%s)', Auth::user()->name, Auth::user()->email));

        $uploadHelper = new UploadHelper($request->file('file'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('file', $fullname);
        $request->request->set('filename', $filename);
        $request->request->set('file_type', $fileType);

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
     * Show the documentation for editing the specified resource.
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
    public function update(DocumentationUpdateRequest $request, $id)
    {
        $this->checkPermission('update '.$this->permission);
        $request->request->set('updated_by', sprintf('%s (%s)', Auth::user()->name, Auth::user()->email));

        $data = $this->model->findOrFail($id);

        if ($request->file('file')) {
            $uploadHelper = new UploadHelper($request->file('file'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('file', $fullname);
            $request->request->set('filename', $filename);
            $request->request->set('file_type', $fileType);
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

        UploadHelper::delete($data->file);

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
