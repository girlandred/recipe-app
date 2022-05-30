@extends('layouts.app')

@section('title', ucfirst($recipe->name))

@section('content')
    <div class="space-y-4">
        <div class="w-full h-screen/4 lg:h-screen/3">

            <div class="relative flex justify-center w-full h-full rounded-xl bg-gray-600 uppercase text-white">
                <span class="self-center px-2 text-center  text-xl lg:text-5xl">
                    {{ $recipe->name }}
                </span>
            </div>
        </div>
        <div class="w-full p-4 bg-white rounded-md shadow dark:bg-gray-700">
            <div class="flex flex-col lg:flex-row lg:justify-between">
                <h4 class="text-2xl font-bold mb-5 dark:text-gray-200 text-green-700">
                    Recipe Details
                </h4>
                <div class="order-first lg:order-last pb-3 lg:flex lg:space-x-2">
                        <div>
                            @if ($recipe->user->id == Auth::id())
                                <a href="{{ route('recipes.edit', $recipe) }}"
                                    class="w-full lg:w-auto rounded shadow-md py-1 px-2 bg-green-700 text-white hover:bg-green-500 text-xs">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif
                        </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <h4 class="text-2xl font-bold mb-5 dark:text-gray-200 text-green-700">
                        Ingredients
                    </h4>
                    <p class="mb-5 dark:text-gray-200">
                    <ul>
                        @foreach ($recipe->ingredients as $ingredient)
                            <li class="dark:text-gray-200"">
                                    {{ $ingredient->pivot->quantity }} {{ $ingredient->name }}
                                </li>
     @endforeach
                    </ul>
                    </p>
                </div>
                <div class="md:col-span-2">
                    <h4 class="text-2xl font-bold mb-5 dark:text-gray-200 text-green-700">
                        Method
                    </h4>
                    <article class="max-w-full prose dark:prose-dark">
                    </article>
                </div>
            </div>
        </div>
    </div>
@endsection
