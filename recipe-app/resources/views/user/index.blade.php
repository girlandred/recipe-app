@extends('layouts.app')

@section('title', 'Profile ')

@section('content')
    @if (Auth::user()->id == $user->id)
        <form method="POST" enctype="multipart/form-data">
            @csrf <div class="w-full md:col-span-4">
                <input type="file" name="avatar" id="avatar"
                    class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
            </div>
            <button type="submit"
                class="w-full lg:w-auto rounded shadow-md py-2 px-4 bg-green-700 text-white hover:bg-green-500">
                Add Photo
            </button>
        </form>
    @endif
    <img class="profile-user-img img-fluid rounded-circle user_picture" width="150"
        src="{{ asset('user_img/' . $user->avatar) }}" alt="User profile picture">

@endsection
