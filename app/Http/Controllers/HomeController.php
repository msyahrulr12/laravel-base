<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\ContactUs;
use App\Models\SocialMedia;
use App\Models\VisionMission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.client.index', []);
    }
}
