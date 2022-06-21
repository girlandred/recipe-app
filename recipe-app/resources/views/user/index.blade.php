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
                    <span class="text-gray-400"> {{ __('main.recipes') }}</span>
                </div>
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">10</p>
                    <span class="text-gray-400">{{ __('main.followers') }}</span>
                </div>
                <div class="font-semibold text-center mx-4">
                    <p class="text-black">102</p>
                    <span class="text-gray-400">{{ __('main.folowing') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col space-y-2 mt-3"></div>
    @if (Auth::user()->id == $user->id)
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                            class="font-semibold">{{ __('main.click') }}</span> {{ __('main.drag') }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                        800x400px)</p>
                </div>
                <input id="dropzone-file" type="file" name="avatar" id="avatar" class="hidden" multiple
                    data-allow-reorder="true" />
            </label>
            <button type="submit"
                class="w-full lg:w-auto rounded shadow-md py-2 px-4 
                bg-gray-200 text-black text-md rounded hover:shadow hover:bg-gray-300 mb-2">
                {{ __('main.add') }}
            </button>
        </form>
    @endif
@endsection
