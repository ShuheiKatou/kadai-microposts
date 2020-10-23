@if (Auth::user()->is_favorite($micropost->id))
    {{-- お気に入り解除 --}}
    {!! Form::open(['route' => ['favorites.unfavorite', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfav', ['class' => "btn btn-danger"]) !!}
    {!! Form::close() !!}
@else
    {{-- お気に入り --}}
    {!! Form::open(['route' => ['favorites.favorite', $micropost->id]]) !!}
        {!! Form::submit('fav', ['class' => "btn btn-success"]) !!}
    {!! Form::close() !!}
@endif
