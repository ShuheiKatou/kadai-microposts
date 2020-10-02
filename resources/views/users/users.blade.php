@if (count($users) >0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
        <li class ="media">
            <img class ="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' =>50]) }}" alt="">
            <div class="media">
                <div class="media-body">
                    {{ $user->name }}
                </div>
                <div>
                    <p>{!! Link_to_route('users.show','View profile',['user' =>$user->id]) !!}</p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {{ $users->links() }}
@endif