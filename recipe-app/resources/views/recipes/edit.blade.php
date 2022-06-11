@extends('layouts.app')

@section('title', 'Edit - ' . ucfirst($recipe->name))

@section('content')
    <div class="w-full rounded-md shadow-md bg-white dark:bg-gray-700">
        <div class="w-full p-4 border-b border-gray-200">
            <p class="font-bold dark:text-gray-200">
                Create New Meal
            </p>
        </div>
        <div class="p-3">
            <form action="{{ route('recipes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                    <div class="items-start md:grid md:grid-cols-9 md:space-x-6">
                        <label for="name" class="dark:text-gray-200 self-center">
                            Name
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="text" name="name" id="name" value="{{ Request::old('name', $recipe->name) }}"
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
                            # of Servings
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="text" name="servings" id="servings"
                                value="{{ Request::old('servings', $recipe->servings) }}"
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
                            Time in Minutes
                        </label>
                        <div class="w-full md:col-span-4">
                            <input type="text" name="timing" id="timing"
                                value="{{ Request::old('timing', $recipe->timing) }}"
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
                            Recipe Type
                        </label>
                        <div class="w-full md:col-span-4">
                            <select name="category_id"
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $recipe->category_id ? 'selected' : '' }}>
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
                    <div class="md:space-y-2">
                        <label class="dark:text-gray-200 self-center">
                            Ingredients
                        </label>
                        @error('ingredients')
                            <p class="text-red-500 italic text-xs font-light">
                                {{ $message }}
                            </p>
                        @enderror
                        @livewire('recipes.create', ['recipe' => $recipe])
                    </div>
                    <div class="">
                        <label class="dark:text-gray-200 self-center">
                            Specifications
                        </label>
                        <select name="specifications[]" id="specifications" multiple x-data="{}"
                            x-init="function() { choices($el) }">
                            @foreach ($specifications as $specification)
                                <option value="{{ $specification->id() }}"
                                    @if (in_array($specification->id(), $oldSpecifications)) selected @endif>
                                    {{ $specification->name() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="md:space-y-2">
                        <label for="directions" class="dark:text-gray-200 self-center">
                            directions
                        </label>
                        <div>
                            <textarea name="directions" id="directions"
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full h-64 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">{!! old('directions', $recipe->directions) !!}</textarea>
                        </div>
                    </div>
                    <div class="w-full md:col-span-4 grid grid-cols-1 md:grid-cols-12">
                        @if ($recipe->getMedia()->count() > 0)
                            <div class="md:col-span-2">
                                <img src="{{ $recipe->getFirstMediaUrl() }}" class="h-16 rounded">
                            </div>
                        @endif
                        <div class="w-full md:col-span-4">
                            <input type="file" name="image" id="image"
                                class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full lg:w-auto rounded shadow-md py-2 px-4 bg-green-700 text-white hover:bg-green-500">
                            Update Meal
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
                toolbar: ['heading', '|', 'bold', 'italic', '|', 'undo', 'redo', '|', 'bulletedList', 'numberedList'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
