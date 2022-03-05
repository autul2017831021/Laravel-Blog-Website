@extends('layouts.app')
@section('content')
<div class="flex-center position-ref full-height">
    <div >
        <div class="no-auth-home-page">
            Please <a class="no-text-decoration" href="{{url('login')}}">login</a> or <a class="no-text-decoration" href="{{url('register')}}">register</a> to see the content of this site
        </div>
    </div>
</div>
@endsection