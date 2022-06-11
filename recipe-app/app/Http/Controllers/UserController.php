<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAvatarRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('user.index', compact('user'));
    }

    public function store(StoreUserAvatarRequest $request)
    {
        $path = public_path('user_img');
        $file = $request->file('avatar');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move($path, $new_name);
        if ($upload) {
            User::find(Auth::user()->id)->update(['avatar' => $new_name]);
        }
        return redirect()->back();
    }
}
