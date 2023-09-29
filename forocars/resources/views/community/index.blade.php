@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Left colum to show all the links in the DB --}}

            <div class="col-md-8">
                <h1>Community</h1>
                @foreach ($links as $link)
                    <li>
                        <a href="{{ $link->link }}" target="_blank">
                            {{ $link->title }}
                        </a>
                        <small>Contributed by: {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}</small>
                    </li>
                @endforeach

            </div>
            @auth
                {{-- Right colum to show the form to upload a link --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3>Contribute a link</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="/community">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Title:</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="What is the title of your article?" class="@error('title') is-invalid @enderror">
                                </div>
                                @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                                <div class="form-group">
                                    <label for="link">Link:</label>
                                    <input type="text" class="form-control" id="link" name="link"
                                        placeholder="What is the URL?" class="@error('link') is-invalid @enderror">
                                </div>
                                @error('link')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group pt-3">
                                    <button class="btn btn-primary">Contribute!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        {{ $links->links() }}
    </div>
@stop
