<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardMemberCreateRequest;
use App\Http\Requests\CardMemberRequest;
use App\Http\Requests\CardMemberUpdateRequest;
use App\Models\CardMember;
use App\Service\IdCardService;
use App\Service\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class CardMemberController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.card_members.';
    private $baseView = 'pages.admin.card_member.';
    private $title = 'Setting Kartu Anggota';
    private $permission = 'card_members';
    private $columns = [
        'code' => [
            'title' => 'Kode',
            'type' => self::TYPE_TEXT,
            'show' => true,
            'trim' => false,
        ],
        'created_by' => [
            'title' => 'Dibuat Oleh',
            'type' => self::TYPE_TEXT,
            'show' => true,
            'trim' => false,
        ],
        'created_at' => [
            'title' => 'Dibuat Pada',
            'type' => self::TYPE_TEXT,
            'show' => true,
            'trim' => false,
        ],
    ];

    private $detailColumns = [
        'code' => [
            'title' => 'Kode',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'front_background_image' => [
            'title' => 'Background Kartu Depan',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'profile_height' => [
            'title' => 'Tinggi Foto Profil',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'profile_width' => [
            'title' => 'Lebar Foto Profil',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'profile_position' => [
            'title' => 'Posisi Foto Profil',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'profile_offset_x' => [
            'title' => 'Posisi Offset X Foto Profil',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'profile_offset_y' => [
            'title' => 'Posisi Offset Y Foto Profil',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'qrcode_height' => [
            'title' => 'Tinggi Foto QR Code',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'qrcode_width' => [
            'title' => 'Lebar Foto QR Code',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'qrcode_position' => [
            'title' => 'Posisi Foto QR Code',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'qrcode_offset_x' => [
            'title' => 'Posisi Offset X Foto QR Code',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'qrcode_offset_y' => [
            'title' => 'Posisi Offset Y Foto QR Code',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'name_height' => [
            'title' => 'Tinggi Foto Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'name_width' => [
            'title' => 'Lebar Foto Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'name_position' => [
            'title' => 'Posisi Foto Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'name_offset_x' => [
            'title' => 'Posisi Offset X Foto Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'name_offset_y' => [
            'title' => 'Posisi Offset Y Foto Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'member_code_height' => [
            'title' => 'Tingi Foto Kode Member',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'member_code_width' => [
            'title' => 'Lebar Foto Kode Member',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'member_code_position' => [
            'title' => 'Posisi Foto Kode Member',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'member_code_offset_x' => [
            'title' => 'Posisi Offset X Foto Kode Member',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'member_code_offset_y' => [
            'title' => 'Posisi Offset Y Foto Kode Member',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'back_background_image' => [
            'title' => 'Background Kartu Belakang',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'created_at' => [
            'title' => 'Dibuat Tanggal',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'updated_at' => [
            'title' => 'Terakhir Diubah Tanggal',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'deleted_at' => [
            'title' => 'Dihapus Tanggal',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'created_by' => [
            'title' => 'Dibuat Oleh',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'updated_by' => [
            'title' => 'Terakhir Diubah Oleh',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'deleted_by' => [
            'title' => 'Dihapus Oleh',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
    ];

    public function __construct(CardMember $model)
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
    public function store(CardMemberCreateRequest $request)
    {
        $this->checkPermission('create '.$this->permission);
        $request->request->set('created_by', sprintf('%s (%s)', Auth::user()->name, Auth::user()->email));

        $uploadHelper = new UploadHelper($request->file('front_background_image'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('front_background_image', $fullname);

        $uploadHelper = new UploadHelper($request->file('back_background_image'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('back_background_image', $fullname);

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
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CardMemberUpdateRequest $request, $id)
    {
        $this->checkPermission('update '.$this->permission);
        $request->request->set('updated_by', sprintf('%s (%s)', Auth::user()->name, Auth::user()->email));

        $data = $this->model->findOrFail($id);

        if ($request->file('front_background_image')) {
            $uploadHelper = new UploadHelper($request->file('front_background_image'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('front_background_image', $fullname);
        }

        if ($request->file('back_background_image')) {
            $uploadHelper = new UploadHelper($request->file('back_background_image'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('back_background_image', $fullname);
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

    public function generateExampleCard($id)
    {
        $cardMember = CardMember::findOrFail($id);

        $idCardService = IdCardService::generateExample($cardMember);
        dd($idCardService);
    }
}
