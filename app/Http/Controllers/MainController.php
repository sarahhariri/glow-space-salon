<?php

namespace App\Http\Controllers;

use App\Models\AboutImage;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function home(){
     $aboutImages = AboutImage::take(4)->get();
        $slides = Slide::All();
        $reviews = Review::where('is_approved', true)->latest()->take(6)->get();
        $services = Service::where('is_active', true)->oldest()->get();
        $team = TeamMember::where('is_active', true)->oldest()->get();
        $settings = Setting::firstOrFail();
        return view('main.home', compact('slides', 'aboutImages', 'reviews', 'services', 'team', 'settings'));
    }
}
