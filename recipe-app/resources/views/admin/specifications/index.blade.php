@extends('admin.layout')

@section('title', 'Specifications')
@stack('admin.content')
@section('admin.content')
    @livewire('specifications.index')
@endsection
