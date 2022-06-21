@extends('layouts.app')

@section('title', 'Create New Recipe')

@section('content')
    <div class="w-full rounded-md shadow-md bg-white dark:bg-gray-700">
        <div class="w-full p-4 border-b border-gray-200">
            <p class="font-bold dark:text-gray-200">
                {{ __('main.create_recipes') }}
            </p>
        </div>
        <div class="p-3">
            <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="name" class="dark:text-gray-200 self-center">
                            {{ __('main.title') }}
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="text" name="name" id="name" value="{{ Request::old('name') }}"
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                            @error('name')
                                <p class="text-red-500 italic text-xs font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="servings" class="dark:text-gray-200 self-center">
                            {{ __('main.servings') }}
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="text" name="servings" id="servings" value="{{ Request::old('servings') }}"
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                            @error('servings')
                                <p class="text-red-500 italic text-xs font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="timing" class="dark:text-gray-200 self-center">
                            {{ __('main.time') }}
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="text" name="timing" id="timing" value="{{ Request::old('timing') }}"
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                            @error('timing')
                                <p class="text-red-500 italic text-xs font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="category_id" class="dark:text-gray-200 self-center">
                            {{ __('main.type') }}
                        </label>
                        <div class="w-full md:col-span-4">
                            <select name="category_id"
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 italic text-xs font-light">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label class="dark:text-gray-200 self-center">
                            {{ __('main.specifications') }}
                        </label>
                        <div class="w-full md:col-span-4">
                            <select
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200"
                                name="specifications[]" id="specifications" multiple x-data="{}"
                                x-init="function() { choices($el) }">
                                @foreach ($specifications as $specification)
                                    <option value="{{ $specification->id() }}">{{ $specification->name() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="image" class="dark:text-gray-200 self-top">
                            {{ __('main.image') }}
                        </label>
                        <div class="w-full md:col-span-4">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <p class="mb-2 text-center text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">{{ __('main.click') }}</span> {{ __('main.drag') }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                        800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" name="image" class="hidden" multiple
                                    data-allow-reorder="true" />
                            </label>
                        </div>
                    </div>
                    <div class="md:space-y-2">
                        <label class="dark:text-gray-200 self-center">
                            {{ __('main.ingredients') }}
                        </label>
                        @error('ingredients')
                            <p class="text-red-500 italic text-xs font-light">
                                {{ $message }}
                            </p>
                        @enderror
                        @livewire('recipes.create')
                    </div>
                    <div class="md:space-y-2">
                        <label for="directions" class="dark:text-gray-200 self-center">
                            {{ __('main.directions') }}
                        </label>
                        <div>
                            <textarea name="directions" id="directions"
                                class="block px-0 w-full text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                placeholder={{ __('main.write_directions') }}>{!! old('directions') !!}</textarea>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full lg:w-auto rounded shadow-md py-2 px-4 bg-green-700 text-white hover:bg-green-500">
                            {{ __('main.add_meal') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#directions'), {
                toolbar: ['heading', '|', 'bold', 'italic', '|', 'undo', 'redo'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
