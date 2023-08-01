@extends('layout.layout')

@section('content')
<form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="{{ route('update.profile') }}" >
    <div class="row">
        <div class="col-md-4 border-right">
        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            @php($profile_image = auth()->user()->profile_image)
            <img class="rounded-circle mt-5" height="250" width="250" src="@if($profile_image == null) {{ asset("storage/profile_images/avatar.png") }}  @else {{ asset("storage/$profile_image") }} @endif" id="image_preview_container">
            <span class="font-weight-bold">
                <input type="file" name="profile_image" id="profile_image"  class="form-control">
            </span>
        </div>
        </div>
        <div class="col-md-8 border-right">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="text-right">Profile Settings</h4>
            </div>
            <div class="row" id="res"></div>
            <div class="row mt-2">

                <div class="col-md-6">
                    <label class="labels">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="first name" value="{{ auth()->user()->name }}">
                </div>
                <div class="col-md-6">
                    <label class="labels">Email</label>
                    <input type="text" name="email" disabled class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="labels">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="{{ auth()->user()->phone }}">
                </div>
                <div class="col-md-6">
                    <label class="labels">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ auth()->user()->address }}" placeholder="Address">
                </div>
            </div>
            <div class="mt-5 text-center"><button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
        </div>
        </div>
    </div>   
</form>
@endsection