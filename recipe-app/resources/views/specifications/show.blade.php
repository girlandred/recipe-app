@extends('layouts.app')

@section('title', $specification->name)

@section('content')

    <div class="w-full p-4 bg-white border-b border-gray-200 rounded-t-md dark:bg-gray-700">
        <p class="font-bold dark:text-gray-200">
            {{ $specification->name }}
        </p>
    </div>

    <div class="w-full rounded-md shadow-md bg-white dark:bg-gray-700 h-full">
        <div class="p-4 space-y-4">
            @if ($specification->recipes()->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-5">
                    @foreach ($specification->recipes as $recipe)
                        <a href="{{ route('recipes.show', $recipe) }}">
                            <div class="w-full h-full rounded-md shadow-md dark:bg-gray-700">
                                <div class="bg-white p-4 rounded-b-md dark:bg-gray-700 dark:text-gray-200">
                                    <p class="mb-2">
                                        {{ $recipe->name }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                No Recipes are using this specification.
            @endif
        </div>
    </div>
@endsection
