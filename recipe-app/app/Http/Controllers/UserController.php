<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index(User $user)
    {
        return view('user.index', compact('user'));
    }

    function crop(Request $request)
    {
        $path = public_path('user_img');

        $file = $request->file('UIMG_202202206212b834dbd3c.jpg');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';

        //Upload new image
        $upload = $file->move($path, $new_name);
        if ($upload) {
            User::find(Auth::user()->id)->update(['avatar' => $new_name]);
            return response()->json([
                'status' => 1,
                'message' => __('main.success'),
                'name' => $new_name
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => __('main.error'),
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $query = User::find(Auth::user()->id)->update([
            'name' => $request->name,
        ]);

        if (!$query) {
            return response()->json([
                'status' => 0,
                'message' => __('main.error'),
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'message' => __('main.success'),
            ]);
        }
    }
}
