@extends('layouts.app')

@section('content')
    @auth
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    Welcome
                </div>
                <a class="sub-title no-text-decoration" href="{{ url('blog/create') }}">Create New Blog</a>
                <br></br>
                <a class="sub-title no-text-decoration" href="{{ url('blog') }}">Our Blog!</a>
            </div>
        </div>
    @else
        @include('guest-index')
    @endauth

@endsection