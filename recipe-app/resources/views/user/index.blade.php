@extends('layouts.app')

@section('title', Auth::user()->name)

@section('content')
    <div class="w-full rounded-md shadow-md bg-white dark:bg-gray-700">
        <div class="bg-white shadow rounded-lg p-10">
            <div class="flex flex-col gap-1 text-center items-center">
                <img class="h-32 w-32 bg-white p-2 rounded-full shadow mb-4" src="{{ asset('user_img/' . $user->avatar) }}"
                    alt="">
                <p class="font-semibold">{{ $user->name }}</p>
                @if (isset($badge))
                    <div class="text-sm leading-normal text-gray-400 flex justify-center items-center">
                        <i class="far fa-star"></i>
                        {{ $user->getPoints() }}
                        {{ $badge }}
                    </div>
                @endif
            </div>
            <div class="flex justify-center items-center gap-2 my-3">
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">{{ $user->recipes->count() }}</p>
                    <span class="text-gray-400">Recipes</span>
                </div>
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">10</p>
                    <span class="text-gray-400">Followers</span>
                </div>
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">102</p>
                    <span class="text-gray-400">Folowing</span>
                </div>
            </div>
        </div>
    </div>
@endsection
