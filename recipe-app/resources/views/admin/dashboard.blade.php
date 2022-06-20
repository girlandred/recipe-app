@extends('admin.layout')

@section('title', 'Admin Dashboard')

@section('admin.content')
    <div class="grid grid-cols-1 lg:grid-cols-4 p-4 gap-4">
        <div class="shadow-lg rounded-lg p-4 bg-gradient-to-br from-green-400 to-blue-500 h-32">
            <p class="font-black text-white text-xl">
                {{ $recipes }}
            </p>
            <p class="font-black text-white text-xl">
                {{ __('main.recipes') }}
            </p>
        </div>
        <div class="shadow-lg rounded-lg p-4 bg-gradient-to-br from-green-400 to-blue-500 h-32">
            <p class="font-black text-white text-xl">
                {{ $ingredients }}
            </p>
            <p class="font-black text-white text-xl">
                {{ __('main.ingredients') }}
            </p>
        </div>
        <div class="shadow-lg rounded-lg p-4 bg-gradient-to-br from-green-400 to-blue-500 h-32">
            <p class="font-black text-white text-xl">
                {{ $specifications }}
            </p>
            <p class="font-black text-white text-xl">
                {{ __('main.specifications') }}
            </p>
        </div>
    </div>
@endsection
