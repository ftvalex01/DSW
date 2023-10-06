@extends('layouts.app')

@section('content')
    <div class="container">
        @include('errors/flash-message')
        <div class="row">
            {{-- Left colum to show all the links in the DB --}}
            <div class="col-md-8">
                <h1>Community</h1>
              @include('./community/links')
            </div>
            @auth
               @include('./community/add-link')
            @endauth
            </div>
        </div>
        {{ $links->links() }}
    </div>
@stop
