<!doctype html>
<html>

    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/links.css') }}">
    </head>

    @if (count($links) === 0)
        <p>No approved contributions yet</p>
    @endif
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->exists('popular') ? '' : 'disabled' }}" href="{{ request()->url() }}">Most
                recent</a>
        </li>
        <li class="nav-item">
            <li class="nav-item">
                <a class="nav-link {{ request()->exists('popular') ? 'disabled' : '' }}" href="?popular{{ request('search') ? '&search=' . request('search') : '' }}">Most popular</a>
            </li>
            
        </li>
    </ul>
    <ul class="list-group">
        @foreach ($links as $link)
            <li class="list-group-item border-radius hvr-sweep-to-right mt-2">
                <span class="me-2 label text-aling-center p-1 border-radius channel label-default"
                    style="background: {{ $link->channel->color }}">
                    <a class="text-decoration-none" href="/community/{{ $link->channel->slug }}">
                        {{ $link->channel->title }}
                    </a>
                </span>
                <a href="{{ $link->link }}" target="_blank">
                    {{ $link->title }}
                </a>
                
                <small>Contributed by: <span class="black-text">{{ $link->creator->name }}</span>
                    {{ $link->updated_at->diffForHumans() }}</small>
                    <i class="fa-regular fa-thumbs-up" style="color: #090a0b;margin-left:1rem"></i>
                <form method="POST" action="/votes/{{ $link->id }}">
                    {{ csrf_field() }}
                    <button type="submit"
                        class="btn btn-secondary {{ Auth::check() && Auth::user()->votedFor($link) ? 'btn-success' : 'btn-secondary' }}"
                        {{ Auth::guest() ? 'disabled' : '' }}>
                        {{ $link->users()->count() }}
                    </button>

                </form>

                <p class="votes">Votos: {{ $link->users->count() }}</p>
        @endforeach

    </ul>
    {{ $links->appends($_GET)->links() }}
