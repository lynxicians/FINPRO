@extends('layout.layout')

@section('content')
    <div class="notificationManagement-cover">
        @include('partial.sidebar')
        <div class="notificationManagementWrapper w-100 h-100">
            <div class="card-body rounded shadow d-flex flex-column gap-3">
                @foreach ($content as $item)
                <div class="card">
                    <div class="border-bottom border-dark">
                        <div class="card-body">
                          <h5 class="card-text">
                            {{ $item->title }}
                          </h5>

                          <p class="card-text">
                            {{ $item->body }}
                        </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>  
        </div>
    </div>
@endsection




