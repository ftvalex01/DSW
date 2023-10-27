<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/links.css') }}" >
</head>

@if(count($links) === 0)
    
<p>No approved contributions yet</p>

@endif
<ul class="list-group">
    @foreach ($links as $link)
    <li class="list-group-item border-radius hvr-sweep-to-right mt-2"> 
        <span class="me-2 label text-aling-center p-1 border-radius channel label-default" style="background: {{ $link->channel->color }}">
            <a class="text-decoration-none" href="/community/{{ $link->channel->slug }}">
                {{ $link->channel->title }}
            </a>
        </span>
        <a href="{{ $link->link }}" target="_blank">
            {{ $link->title }}
        </a>
        <small>Contributed by: <span class="black-text">{{ $link->creator->name }}</span> {{ $link->updated_at->diffForHumans() }}</small>
        <form method="POST" action="/votes/{{ $link->id }}">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-secondary {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-secondary' }}" {{ Auth::guest() ? 'disabled' : '' }}>
                {{ $link->users()->count() }}
            </button>
            
        </form>
        
    <p class="votes">Votos: {{ $link->users->count() }}</p>
@endforeach

</ul>