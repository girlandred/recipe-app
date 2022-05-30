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
                        <input type="text" name="name" id="name" value="{{ Request::old('name', $recipe->name) }}" class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full lg:w-60 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">
                        @error('name')
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
                <div class="md:space-y-2">
                    <label for="directions" class="dark:text-gray-200 self-center">
                        directions
                    </label>
                    <div>
                        <textarea name="directions" id="directions" class="border-1 border-gray-100 shadow bg-opacity-20 rounded-lg placeholder-gray-500 w-full h-64 focus:outline-none focus:ring-1 focus:border-green-500 focus:ring-green-500 dark:bg-gray-900 dark:border-transparent dark:text-gray-200">{!! old('instruction', $recipe->instruction) !!}</textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full lg:w-auto rounded shadow-md py-2 px-4 bg-green-700 text-white hover:bg-green-500">
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
        .create( document.querySelector( '#directions' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', '|',  'undo', 'redo', '|', 'bulletedList', 'numberedList' ],
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection