<?php

namespace App\Http\Controllers;

use App\Models\Documentation;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    private $model;

    public function __construct(Documentation $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $datas = $this->model->orderBy('created_at', 'desc')->paginate(8);
        return view('pages.client.documentation.index', [
            'datas' => $datas
        ]);
    }

    public function show($id)
    {
        $data = $this->model->findOrFail($id);
        return view('pages.client.documentation.show', [
            'data' => $data
        ]);
    }
}
