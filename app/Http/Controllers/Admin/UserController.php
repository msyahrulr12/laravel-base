<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Service\RoleService;
use App\Service\UploadHelper;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends BaseController
{
    private $model;
    private $baseRoute = 'admin.users.';
    private $baseView = 'pages.admin.user.';
    private $title = 'Pengguna';
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
        'is_logged_in' => [
            'title' => 'Sedang Login',
            'type' => self::TYPE_BOOLEAN,
            'show' => false,
            'trim' => true
        ],
        'status' => [
            'title' => 'Status',
            'type' => self::TYPE_BOOLEAN,
            'show' => false,
            'trim' => true
        ],
        'is_blocked' => [
            'title' => 'Blokir',
            'type' => self::TYPE_BOOLEAN,
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
    private $roleService;
    private $userService;

    public function __construct(
        User $model,
        RoleService $roleService,
        UserService $userService
    )
    {
        $this->model = $model;
        $this->roleService = $roleService;
        $this->userService = $userService;
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
        $result = $this->userService->getAll($perPage);

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

        $role = $this->roleService->getAll();

        // write audit trail
        $activity = sprintf('%s (%s) opening form create %s at %s', $this->getUser()->name, $this->getUser()->email, $this->title, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'create', [
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'data' => [
                'serial_number' => User::getCurrentSerialNumber(),
                'code' => User::generateCode(),
            ],
            'roles' => $role->getData()
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
            // write audit trail
            $activity = sprintf('%s (%s) creating %s with data failed because \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, 'failed upload profile image', date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);

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
            // write audit trail
            $activity = sprintf('%s (%s) creating %s with data failed because \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, 'failed upload ktp image', date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);

            Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
            return redirect()->route($this->baseRoute.'index');
        }
        $fileType = $uploadHelper->getExtension();
        $filename = $uploadHelper->getFilename();
        $fullname = $filename . '.' . $fileType;

        $request->request->set('ktp_image', $fullname);

        $request->request->set('password', bcrypt($request->request->get('password')));

        $result = $this->model->create($request->request->all());

        if ($result) {
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

        // write audit trail
        $activity = sprintf('%s (%s) showing %s with ID %d at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'show', [
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
        // dd($data['roles'][0]);
        $role = $this->roleService->getAll();

        // write audit trai
        $activity = sprintf('%s (%s) opening form edit %s with ID %d at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
        $this->writeAuditTrail($activity, $this->getUser()->name);

        return view($this->commonView.'edit', [
            'data' => $data,
            'title' => $this->title,
            'baseView' => $this->baseView,
            'baseRoute' => $this->baseRoute,
            'roles' => $role->getData(),
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
                // write audit trail
                $activity = sprintf('%s (%s) creating %s with data failed because \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, 'failed reupload profile image', date('Y-m-d H:i:s'));
                $this->writeAuditTrail($activity, $this->getUser()->name);

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
                // write audit trail
                $activity = sprintf('%s (%s) creating %s with data failed because \'%s\' at %s', $this->getUser()->name, $this->getUser()->email, $this->title, 'failed reupload ktp image', date('Y-m-d H:i:s'));
                $this->writeAuditTrail($activity, $this->getUser()->name);

                Alert::error('Terjadi Kesalahan!', 'Gagal mengupload file');
                return redirect()->route($this->baseRoute.'index');
            }
            $fileType = $uploadHelper->getExtension();
            $filename = $uploadHelper->getFilename();
            $fullname = $filename . '.' . $fileType;

            $request->request->set('ktp_image', $fullname);
        }

        $request->request->set('updated_by', Auth::user()->name);
        $request->request->set('ip_address', $request->ip());

        $result = $data->update($request->request->all());

        if ($result) {
            // write audit trail
            $activity = sprintf('%s (%s) updating %s with ID %d success at %s', $this->getUser()->name, $this->getUser()->email, $this->title, $id, date('Y-m-d H:i:s'));
            $this->writeAuditTrail($activity, $this->getUser()->name);

            Alert::success('Edit Data Berhasil', 'Berhasil mengubah data');
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
