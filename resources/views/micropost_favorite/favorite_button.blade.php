@if ($micropost->is_favorite($user->id))
    {!! Form::open(['route' => ['micropost.deleteFavorite', $micropost->id], 'method' => 'delete']) !!}
        {!! Form::submit('Unfavorite', ['class' => 'btn btn-success btn-xs']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['micropost.addFavorite', $micropost->id]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-default btn-xs"]) !!}
    {!! Form::close() !!}
@endif