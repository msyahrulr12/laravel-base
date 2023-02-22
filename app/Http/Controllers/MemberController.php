<?php

namespace App\Http\Controllers;

use App\Models\BoardOfManagement;
use App\Models\Form;
use App\Models\Regulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    private $boardOfManagementModel;
    private $regulationModel;
    private $formModel;

    public function __construct(
        Regulation $regulationModel,
        Form $formModel,
        BoardOfManagement $boardOfManagementModel
    )
    {
        $this->regulationModel = $regulationModel;
        $this->formModel = $formModel;
        $this->boardOfManagementModel = $boardOfManagementModel;
    }

    public function boardOfManagement()
    {
        $data = $this->boardOfManagementModel->first();
        return view('pages.client.member.board-of-management', [
            'data' => $data,
        ]);
    }

    public function regulation()
    {
        $data = $this->regulationModel->first();
        return view('pages.client.member.regulation', [
            'data' => $data,
        ]);
    }

    public function downloadForm()
    {
        $form = $this->formModel->first();
        $filename = 'formulir-pendaftaran-anggota-laskar-merah-putih-'.$form->id.'.'.$form->file_type;

        return Storage::disk('public')->download($form->file, $filename);

        // $file = file_get_contents(asset('storage/'.$form->file));
        // return response()->download($file);
    }
}
