@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Left column to show all the links in the DB --}}
            <div class="col-md-8">
                <a href="/community" style="text-decoration: none; color:inherit">
                    <h1>Community <span style="color: {{ $channel ? $channel->color : 'inherit' }}">{{ $channel ? $channel->title : '' }}</span></h1>
                </a>
                @include('./community/links')
            </div>
            @auth
               @include('./community/add-link')
            @endauth
        </div>
    </div>
@stop

