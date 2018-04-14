<ul class="media-list">
@foreach ($microposts as $micropost)
    <?php $user = $micropost->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $user->id]) !!} <span class="text-muted">posted at {{ $micropost->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($micropost->content)) !!}</p>
            </div>
            <div class="form-group form-inline">
                <span class="input-group">
                @include('micropost_favorite.favorite_button', ['user' => Auth::user(), 'micropost' => $micropost])
                </span>
                @if (Auth::user()->id == $micropost->user_id)
                <span class="input-group">
                    {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                </span>
                @endif
            </div>
            </form>
        </div>
    </li>
@endforeach
</ul>
{!! $microposts->render() !!}