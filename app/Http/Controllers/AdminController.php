<?php

namespace App\Http\Controllers;

use App\Models\AboutImage;
use App\Models\Appointment;
use App\Models\GiftCard;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slide;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    function home(){
          $totalAppointments = Appointment::count();

    $pendingAppointments = Appointment::where('status', 'pending')->count();

    $confirmedAppointments = Appointment::where('status', 'confirmed')->count();
    $completedAppointments = Appointment::where('status', 'completed')->count();

    $totalServices = Service::count();

    $totalTeam = TeamMember::count();

    $totalReviews = Review::count();

    $totalGiftCards = GiftCard::count();
        return view('admin.home', compact('totalAppointments', 'pendingAppointments', 'confirmedAppointments', 'completedAppointments', 'totalServices', 'totalTeam', 'totalReviews', 'totalGiftCards'));
    }

    function slides(){
        $slides = Slide::all();
        return view('admin.slides',compact('slides'));
    }
      function deleteSlide(Slide $slide){
        $slide->delete();
        return redirect()->back();
    }
    function addSlides (Request $request){
        $fields = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,avif,webp', 'max:2048']
        ]);
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/images/slides'), $imageName);
        $fields['image'] = $imageName;
        Slide::create($fields);
        return redirect()->back();
    }
function aboutImages(){
    $aboutImages = AboutImage::all();
    return view('admin.about-images', compact('aboutImages'));
}

 function addaboutImages(Request $request)
{
    $fields = $request->validate([
        'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp,avif', 'max:2048'],
    ]);

    $image = $request->file('image');
    $imageName = time() . '_' . $image->getClientOriginalName();

    $image->move(
        public_path('assets/images/about'),
        $imageName
    );

    $fields['image'] = $imageName;

    AboutImage::create($fields);

    return redirect()->back()->with('success', 'Image added Succesfully');
}
function deleteaboutImages(AboutImage $aboutImage)
{
    $imagePath = public_path(
        'assets/images/about/' . $aboutImage->image
    );

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $aboutImage->delete();

    return redirect()->back()->with('success', 'Image added Succesfully');
}


    function allUsers(){
        $users = User::withTrashed()->get();
        $title = "All";
        return view('admin.users', compact('users', 'title'));
    }
    function deletedUsers(){
         $users = User::onlyTrashed()->get();
         $title= "Deleted";
        return view('admin.users', compact('users', 'title'));
    }
    function deleteUser(User $user){
        $user->role = 'user';
        $user->save();
        $id = $user->id;
        $user->delete();
        return redirect()->back()->with('success', 'User ' . $user->name . 'deleted succesfully');
    }
        function makeAdmin(User $user) {
        if($user->role == 'admin'){
            $user->role = 'user';
        } else {
            $user->role = 'admin';  
        }
        $user->save();
        return redirect()->back()->with('success', 'User named ' . $user->name . ' role changed successfully');
    }

    function forceDeleteUser($id){
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDeleteUser();
        return redirect()->back();
    }
     function restoreUser($id){
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->back()->with('success', 'User named ' . $user->name . ' restored successfully');
    }
    

    function activeUsers(){
        $users = User::all();
        $title = "Active";
        return view('admin.users', compact('users', 'title'));
    }
}
