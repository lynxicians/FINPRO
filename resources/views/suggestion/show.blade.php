@extends('layout.layout')
@php
    use Carbon\Carbon;
@endphp

@section('content')
<div class="show-cover">
    <div class="voice-container">
        <div class="c-container">
            @foreach ($content as $item )
                <div class="head">{{ $item->title }}</div>
                <div class="body">{!! $item->content !!}</div>
            @endforeach
        </div>
    </div>
        <div class="comment-cover">
            <div class="voice-container">
                <div class="com-container">
                    <div class="head">Comments</div>
                    <div class="body">
                        @foreach ($comments as $item)
                        <div class="comment-wrapper">
                            <div class="head-wrapper">
                                <div class="username">{{ $item->user->name }}</div>
                                <div class="comment-time">{{ Carbon::parse($item->created_at)->format('l, F j, Y | h:ia') }}</div>
                            </div>
                            <div class="body-wrapper">
                            {{ $item->content }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <form action="{{ route('comment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @foreach ($content as $item )
                        <input type="hidden" name="suggestion_id" value="{{ $item->id }}">
                    @endforeach
                    <div class="com-container">
                        <div class="title">Comments Here!</div>
                        <div class="input-group padding-24">
                            <textarea name="content" onkeyup="auto_grow(this)" class="form-control" aria-label="With textarea"></textarea>
                        </div>
                        <div class="btn-wrapper w-100 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
        </div>
</div>
@endsection

@push('scripts')
<script>
    function auto_grow(element){
        element.style.height = "100px";
        element.style.height = (element.scrollHeight) + "px";
    }D
</script>
@endpush