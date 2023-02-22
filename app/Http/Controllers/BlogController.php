<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    private $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $datas = $this->model->orderBy('created_at', 'desc')->get();
        return view('pages.client.blog.index', [
            'datas' => $datas
        ]);
    }

    public function show(Request $request, $slug)
    {
        $data = $this->model->whereSlug($slug)->first();
        if (!$data) abort(404);

        return view('pages.client.blog.blog-details', [
            'data' => $data
        ]);
    }
}
