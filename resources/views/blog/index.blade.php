@extends('layouts.app')
@section('content')
    @auth
        <div class="container">
            <div class="row">
                <div class="col-12 pt-2">
                    <div class="row">
                        <div class="col-8">
                            <h1 class="display-one">Our Blog!</h1>
                            <p>Enjoy reading our blogs. Click on a post to read!</p>
                        </div>
                        <div class="col-4">
                            <p>Create new Blog</p>
                            <a href="{{ url('blog/create') }}" class="btn btn-primary btn-sm">Add Post</a>
                        </div>
                    </div>                
                    @forelse($blogs as $blog)
                        <ul>
                            <li><a href="{{ url('blog').'/'.$blog->id }}">{{ ucfirst($blog->title) }}</a></li>
                        </ul>
                    @empty
                        <p class="text-warning">No blogs available</p>
                    @endforelse
                </div>
            </div>
        </div>
    @else
        @include('guest-index')
    @endauth
@endsection