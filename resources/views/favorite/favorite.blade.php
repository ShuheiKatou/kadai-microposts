@if (count($microposts) >0)
    @foreach ($microposts as $micropost)
        @if(Auth::user()->is_favorite($micropost->id))
            <ul class ="list-unstyled">
                
                <li class="media mb-3">
                    <img class ="mr-2 rounded" src="{{ Gravatar::get($micropost->user->email,['size' =>50]) }}" alt ="">
                    <div class="media-body">
                        <div>
                            {!! link_to_route('users.show',$micropost->user->name,['user'=>$micropost->user->id]) !!}
                            <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                        </div>
                        <div>
                            <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                        </div>
                        <div>
                            @include('favorite.fav_botton')
                            @if (Auth::user()->is_favorite($micropost->id))
                            
                            {!! Form::open(['route' =>['microposts.destroy',$micropost->id],'method' =>'delete']) !!}
                                {!! Form::submit('Delete',['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                            @endif
                            
                        </div>
                    </div>
                </li>
            </ul>
            {{ $microposts->links() }}
        @endif
    @endforeach
@endif