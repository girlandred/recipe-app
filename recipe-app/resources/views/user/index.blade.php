@extends('layouts.app')

@section('title', 'Profile ')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if (!isset($user->id->avatar))
                                <img class="profile-user-img img-fluid rounded-circle user_picture" width="150"
                                    src="{{ asset('user_img/' . $user->avatar) }}" alt="User profile picture">
                            @else
                                <img class="profile-user-img img-fluid rounded-circle user_picture" width="150"
                                    src="{{ asset('user_img/nothing.png') }}" alt="User profile picture">
                            @endif
                            <div class="mt-3">

                                @if (Auth::user()->id == $user->id)
                                    <input type="file" name="admin_image" id="admin_image"
                                        style="opacity: 0;height:1px;display:none">
                                    <button class="btn custom" id="change_picture_btn">{{ __('main.edit_photo') }}
                                        </a>
                                    @else
                                        <button class="btn btn-primary">{{ __('main.follow') }}</button>
                                        <button class="btn btn-outline-primary">{{ __('main.message') }}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header p-2">
                        <li class="nav-item">{{ __('main.personal_info') }}</li>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            @if (Auth::user()->id == $user->id)
                                <div class="active tab-pane" id="personal_info">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                                        id="personal_info_form">
                                        <div class="form-group row">
                                            <label for="inputName"
                                                class="col-sm-2 col-form-label">{{ __('main.name') }}</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName"
                                                    placeholder="{{ __('main.name') }}" value="{{ $user->name }}"
                                                    name="name">

                                                <span class="text-danger error-text name_error"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" id="submit"
                                                    class="btn btn-danger">{{ __('main.save_changes') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="active tab-pane" id="personal_info">
                                    <div class="form-group row">
                                        <label for="inputName"
                                            class="col-sm-2 col-form-label">{{ __('main.name') }}</label>
                                        <div class="col-sm-2 col-form-label">
                                            {{ $user->name }}
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
