@extends('layouts.app')

@section('content')

    @if(Auth::check())
        <div clas="row">
            <aside class="col-sm-4">
                @include('users.card')
            </aside>
            <div class="col-sm-8">
                @include('microposts.form')
                @include('microposts.microposts')
            </div>
        </div>
    @else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Microposts</h1>
            {!! Link_to_route('signup.get','Sign up now!',[],['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
    @endif
@endsection