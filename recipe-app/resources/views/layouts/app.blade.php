<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Mealing is an application that allows you to create menus using lists of recipes from the community">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="{{ asset('plugins/ijaboCropTool.min.css') }}">

    @livewireStyles
    <script src="https://kit.fontawesome.com/a357069ed8.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>
        @if (trim($__env->yieldContent('title')))
            @yield('title') |
        @endif Mealing
    </title>
    @livewireScripts
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
</head>

<body>
    <div class="w-full min-h-screen flex flex-col lg:flex-row bg-gray-100 dark:bg-gray-800">
        <!-- Header -->
        <header>
            @include('layouts.header')
        </header>
        <main class="p-4 lg:p-6 w-full lg:ml-72">
            <!-- Search Bar -->
            <div class="flex flex-col lg:flex-row justify-between mb-4">
                <div class="hidden lg:block text-right relative" x-data="{ open: false }" @click.away="open = false">
                    <div class="text-gray-600 flex items-center space-x-2 cursor-pointer dark:text-gray-200"
                        @click="open = !open">
                        <p>
                            {{ Auth::user()->name }}
                        </p>
                        <button class="px-1.5" aria-label="Profile Menu">
                            <i class="fas fa-angle-down transform duration-300 ease-in-out"
                                :class="{ 'rotate-180': open }"></i>
                        </button>
                    </div>
                    <div class="absolute right-0 z-10" x-cloak x-show.transition.opacity.duration.350ms="open">
                        <div
                            class="w-52 shadow-md rounded-md mt-1 py-2 bg-white text-left flex flex-col dark:bg-gray-700 dark:text-gray-200">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-5 py-2 hover:bg-green-700 hover:text-white"
                                    aria-label="Logout">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main content -->
            <div class="w-full">
                @yield('content')
            </div>
        </main>
    </div>
    @yield('scripts')
    @if (config('app.google_analytics') !== '')
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.google_analytics') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '{{ config('app.google_analytics') }}');
        </script>
    @endif
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('plugins/ijaboCropTool.min.js') }}"></script>

</body>

</html>
