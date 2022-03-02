@extends('layouts.app')
@section('content')
    @auth
        @if(Session::has('unauthorized'))
            <script>
                var message = "{{Session::get('unauthorized')}}";
                Swal.fire('Failed', message, 'error');
            </script>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-12 pt-2">
                    <a href="{{ url('blog') }}" class="btn btn-outline-primary btn-sm">Go back</a>
                    <h1 class="display-one">{{ ucfirst($blog->title) }}</h1>
                    <h2 class="display-two">Author: {{ $authorName }}</h2>
                    <hr>
                        <p>{!! $blog->body !!}</p> 
                    <hr>
                    <!-- <a href="{{ url('#') }}" class="btn btn-outline-primary">Edit Post</a>
                    <br><br> -->
                    
                    <form id="delete-frm" class="" action="{{ url('blog').'/'.$blog->id }}" method="POST">
                        @csrf
                        <button class="btn btn-danger">Delete Post</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        @include('guest-index')
    @endauth
@endsection