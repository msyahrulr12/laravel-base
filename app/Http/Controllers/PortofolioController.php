<?php

namespace App\Http\Controllers;

use App\Models\WorkProgram;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    private $model;

    public function __construct(WorkProgram $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $data = $this->model->first();
        return view('pages.client.portofolio.portofolio', [
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $data = $this->model->findOrFail($id);
        return view('pages.client.portofolio.portfolio-details', [
            'data' => $data
        ]);
    }
}
