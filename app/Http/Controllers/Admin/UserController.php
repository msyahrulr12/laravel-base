<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\CardMember;
use App\Models\Region;
use App\Models\User;
use App\Service\IdCardService;
use App\Service\QrCodeService;
use App\Service\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class UserController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.users.';
    private $baseView = 'pages.admin.user.';
    private $title = 'Member';
    private $permission = 'users';
    private $columns = [
        'name' => [
            'title' => 'Nama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
        'code' => [
            'title' => 'Kode',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
        'email' => [
            'title' => 'Email',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
        'phone_number' => [
            'title' => 'Nomor Telepon',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => false
        ],
        'address' => [
            'title' => 'Alamat',
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
        'code' => [
            'title' => 'Kode',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'region' => [
            'title' => 'Wilayah',
            'type' => self::TYPE_BELONGS_TO,
            'show' => false,
            'trim' => true,
            'child_field' => 'name'
        ],
        'email' => [
            'title' => 'Email',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'phone_number' => [
            'title' => 'Nomor Telepon',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'birthdate' => [
            'title' => 'Tanggal Lahir',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'birthplace' => [
            'title' => 'Tempat Lahir',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'religion' => [
            'title' => 'Agama',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'education' => [
            'title' => 'Pendidikan',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'address' => [
            'title' => 'Alamat',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'job' => [
            'title' => 'Pekerjaan',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'skill' => [
            'title' => 'Keahlian',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'serial_number' => [
            'title' => 'Nomor Urut',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'profile_image' => [
            'title' => 'Foto Profil',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'ktp_image' => [
            'title' => 'Foto KTP',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'qrcode_image' => [
            'title' => 'Gambar QR Code',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'member_name_image' => [
            'title' => 'Gambar Nama Member',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'member_code_image' => [
            'title' => 'Gambar Kode Member',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'front_card_image' => [
            'title' => 'Gambar Depan Kartu Member',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'back_card_image' => [
            'title' => 'Gambar Belakang Kartu Member',
            'type' => self::TYPE_IMAGE,
            'show' => false,
            'trim' => true
        ],
        'is_logged_in' => [
            'title' => 'Sedang Login',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'status' => [
            'title' => 'Status',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'is_blocked' => [
            'title' => 'Blokir',
            'type' => self::TYPE_TEXT,
            'show' => false,
            'trim' => true
        ],
        'ip_address' => [
            'title' => 'IP Address',
            'type' => self::TYPE_TEXT,
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

    public function __construct(User $model)
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
            'regions' => Region::all(),
            'card_members' => CardMember::all(),
            'data' => [
                'serial_number' => User::getCurrentSerialNumber(),
                'code' => User::generateCode(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $this->checkPermission('create '.$this->permission);

        $uploadHelper = new UploadHelper($request->file('profile_image'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('profile_image', $fullname);

        $uploadHelper = new UploadHelper($request->file('ktp_image'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('ktp_image', $fullname);

        $uploadHelper = new UploadHelper($request->file('member_name_image'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('member_name_image', $fullname);

        $uploadHelper = new UploadHelper($request->file('member_code_image'));
        $uploadSuccess = $uploadHelper->upload();
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('member_code_image', $fullname);

        // $qrCodeService = new QrCodeService($this->getUser());
        // $qrCode = file_get_contents($qrCodeService->generate());
        // if (!$qrCode) abort(400);
        // $request->request->set('qrcode_image', $qrCodeService->getFilename());

        $request->request->set('password', bcrypt($request->request->get('password')));

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
            'regions' => Region::all(),
            'card_members' => CardMember::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $this->checkPermission('update '.$this->permission);

        $data = $this->model->findOrFail($id);

        if ($request->file('profile_image')) {
            $uploadHelper = new UploadHelper($request->file('profile_image'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('profile_image', $fullname);
        }

        if ($request->file('ktp_image')) {
            $uploadHelper = new UploadHelper($request->file('ktp_image'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('ktp_image', $fullname);
        }

        if ($request->file('member_name_image')) {
            $uploadHelper = new UploadHelper($request->file('member_name_image'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('member_name_image', $fullname);
        }

        if ($request->file('member_code_image')) {
            $uploadHelper = new UploadHelper($request->file('member_code_image'));
            $uploadSuccess = $uploadHelper->upload($data->file);
            if (!$uploadSuccess) {
                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('member_code_image', $fullname);
        }

        if (!$data->qrcode_image) {
            $qrCodeService = new QrCodeService($this->getUser());
            $qrCode = file_get_contents($qrCodeService->generate());
            if (!$qrCode) abort(400);
            $request->request->set('qrcode_image', $qrCodeService->getFilename());
        }
        $request->request->set('updated_by', Auth::user()->name);
        $request->request->set('ip_address', $request->ip());

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

    public function generateCard($userId)
    {
        $user = User::findOrFail($userId);

        if (!$user->profile_image || !$user->qrcode_image || !$user->member_name_image || !$user->member_code_image) {
            Alert::error('Terjadi Kesalahan!', 'Gagal generate kartu member karena data member kurang lengkap. Mohon lengkapi data berikut : Foto profile, Foto QR Code, Foto Nama Member dan Foto Kode Member');
            return redirect()->route($this->baseRoute.'index');
        }

        $idCardService = new IdCardService($user);
        $fullPath = $idCardService->generate();
        $expFile = explode('/', $fullPath);
        $filename = $expFile[sizeof($expFile) - 1];
        $uploadHelper = new UploadHelper(new UploadedFile($fullPath, $filename));
        $uploadSuccess = $uploadHelper->upload($user->file);
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;
        $frontCardImage = $fullname;

        $fullPath = $idCardService->generateBackCard();
        $expFile = explode('/', $fullPath);
        $filename = $expFile[sizeof($expFile) - 1];
        $uploadHelper = new UploadHelper(new UploadedFile($fullPath, $filename));
        $uploadSuccess = $uploadHelper->upload($user->file);
        if (!$uploadSuccess) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;
        $backCardImage = $fullname;

        $updateCard = [
            'front_card_image' => $frontCardImage,
            'back_card_image' => $backCardImage
        ];

        $result = $user->update($updateCard);
        if ($result) {
            Alert::success('Kartu member berhasil dibuat', 'Berhasil membuat kartu member');
            return redirect()->route($this->baseRoute.'index');
        }

        Alert::error('Terjadi Kesalahan!', 'Gagal membuat kartu member');
        return back();
    }

    public function generateQrCode($userId)
    {
        $user = User::findOrFail($userId);

        $qrCodeService = new QrCodeService($user);
        $qrCode = file_get_contents($qrCodeService->generate());
        if (!$qrCode) abort(400);

        $updateQrCode = [
            'qrcode_image' => $qrCodeService->getFilename(),
        ];

        $result = $user->update($updateQrCode);
        if ($result) {
            Alert::success('QR Code member berhasil dibuat', 'Berhasil membuat QR Code');
            return redirect()->route($this->baseRoute.'index');
        }

        Alert::error('Terjadi Kesalahan!', 'Gagal membuat QR Code');
        return back();
    }
}
