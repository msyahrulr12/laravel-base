<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VisionMissionCreateRequest;
use App\Http\Requests\VisionMissionRequest;
use App\Http\Requests\VisionMissionUpdateRequest;
use App\Models\VisionMission;
use App\Service\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class VisionMissionController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.vision_missions.';
    private $baseView = 'pages.admin.vision_mission.';
    private $title = 'Vision & Mission';
    private $permission = 'vision_missions';
    private $columns = [
        'banner' => [
            'title' => 'Banner',
            'type' => self::TYPE_IMAGE,
            'show' => true,
            'trim' => false
        ],
        'vision_banner' => [
            'title' => 'Banner Visi',
            'type' => self::TYPE_IMAGE,
            'show' => true,
            'trim' => false
        ],
        'vision_content' => [
            'title' => 'Isi Visi',
            'type' => self::TYPE_TEXT,
            'show' => true,
            'trim' => true
        ],
        'mission_banner' => [
            'title' => 'Banner Misi',
            'type' => self::TYPE_IMAGE,
            'show' => true,
            'trim' => false
        ],
        'mission_content' => [
            'title' => 'Isi Misi',
            'type' => self::TYPE_TEXT,
            'show' => true,
            'trim' => true
        ],
    ];
    private $columnType = [
        'banner' => 'img',
        'vision_banner' => 'img',
        'vision_content' => 'string',
        'mission_banner' => 'img',
        'mission_content' => 'string',
    ];

    public function __construct(VisionMission $model)
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisionMissionCreateRequest $request)
    {
        $this->checkPermission('create '.$this->permission);
        $request->request->set('created_by', sprintf('%s (%s)', Auth::user()->name, Auth::user()->email));

        // banner
        $uploadHelper = new UploadHelper($request->file('banner'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('banner', $fullname);
        // $request->request->set('filename', $filename);
        // $request->request->set('file_type', $fileType);

        // vision_banner
        $uploadHelper = new UploadHelper($request->file('vision_banner'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('vision_banner', $fullname);
        // $request->request->set('filename', $filename);
        // $request->request->set('file_type', $fileType);

        // mission_banner
        $uploadHelper = new UploadHelper($request->file('mission_banner'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('mission_banner', $fullname);
        // $request->request->set('filename', $filename);
        // $request->request->set('file_type', $fileType);

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
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VisionMissionUpdateRequest $request, $id)
    {
        $this->checkPermission('update '.$this->permission);
        $request->request->set('updated_by', sprintf('%s (%s)', Auth::user()->name, Auth::user()->email));

        $data = $this->model->findOrFail($id);

        if ($request->file('banner')) {
            $uploadHelper = new UploadHelper($request->file('banner'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('banner', $fullname);
            // $request->request->set('filename', $filename);
            // $request->request->set('file_type', $fileType);
        }

        if ($request->file('vision_banner')) {
            $uploadHelper = new UploadHelper($request->file('vision_banner'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('vision_banner', $fullname);
            // $request->request->set('filename', $filename);
            // $request->request->set('file_type', $fileType);
        }

        if ($request->file('mission_banner')) {
            $uploadHelper = new UploadHelper($request->file('mission_banner'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('mission_banner', $fullname);
            // $request->request->set('filename', $filename);
            // $request->request->set('file_type', $fileType);
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
