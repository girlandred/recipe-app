@extends('admin.layout')

@section('title', 'Ingredients')
@stack('admin.content')
@section('admin.content')
    @livewire('ingredients.index')
@endsection
