@extends('layouts.app')

@section('title', 'Profile ')

@section('content')


    <div class="w-3/4 lg:w-1/2 mx-auto rounded-md shadow-md bg-white dark:bg-gray-700 h-full m-20 p-10 text-center">
ddd

    </div>

    {{-- <div class="space-y-4">
        <div class="w-full rounded-md shadow-md bg-white dark:bg-gray-700 h-full">
            <div class="flex flex-row bg-gray-50 dark:bg-gray-600 shadow rounded p-4 mb-4">
                <div class="flex items-center justify-center flex-shrink-0 h-12 w-12 rounded-xl">
                    <img alt="..." src="{{ asset('user_img/' . $user->avatar) }}" class="w-full h-full rounded-full"
                        style="max-width: 150px;" />
                </div>
            </div>
            <div class="flex flex-col text-center mt-3 mb-4">
                <span class="text-2xl font-medium">{{ $user->name }}</span>
                <span class="text-md text-gray-400">{{ $user->email }}</span>
            </div>
            <p class="px-16 text-center text-md text-gray-800">{{ $user->getPoints() }}</p>
            <div class="px-16 mt-3 text-center">
                @if (!isset($badge))
                    <span class="bg-gray-100 h-5 p-1 px-3 rounded cursor-pointer hover:shadow hover:bg-gray-200">
                        #{{ $badge }}
                    </span>
                @endif
            </div>
            <div class="px-14 mt-5">
                @if (Auth::user()->id == $user->id)
                    <form method="POST" enctype="multipart/form-data">
                        @csrf <div class="w-full md:col-span-4">
                            <input type="file" name="avatar" id="avatar"
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                        </div>
                        <button type="submit"
                            class="h-12 bg-gray-200 w-full text-black text-md rounded hover:shadow hover:bg-gray-300 mb-2">
                            Add Photo
                        </button>
                    </form>
                @endif
            </div>


        </div>
    </div>
    </div> --}}
@endsection
