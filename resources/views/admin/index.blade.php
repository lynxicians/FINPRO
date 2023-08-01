@extends('layout.layout')

@section('content')
<div class="adminManagement-cover">
    @include('partial.adminsidebar')
    <div class="adminManagementWrapper w-100 h-100">
        <div class="border-bottom border-dark">
            <h1>Welcome, Admin</h1>
        </div>
        <div class="card-body rounded shadow mt-4">
            <div class="border-bottom border-dark">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-success">Button</a>
                  <a href="#" class="btn btn-danger">Button</a>
                </div>
            </div>
            <div class="notificationcard border-bottom border-dark">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-success">Button</a>
                  <a href="#" class="btn btn-danger">Button</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


    