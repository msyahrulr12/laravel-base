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
        $visionMission = VisionMission::first();
        $aboutUs = AboutUs::first();
        $socialMedia = SocialMedia::all();
        $contactUs = ContactUs::first();

        return view('pages.client.index', [
            'vision_mission' => $visionMission,
            'about_us' => $aboutUs,
            'social_media' => $socialMedia,
            'contact_us' => $contactUs,
        ]);
    }
}
