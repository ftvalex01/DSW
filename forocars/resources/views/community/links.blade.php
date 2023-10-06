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
        <span  class="me-2 label text-aling-center p-1 border-radius channel label-default" style="background: {{ $link->channel->color }}">
            {{ $link->channel->title }}
        </span>
            <a href="{{ $link->link }}" target="_blank">
                {{ $link->title }}
            </a>
        <small>Contributed by: <span class="black-text">{{ $link->creator->name }}</span> {{ $link->updated_at->diffForHumans() }}</small>
    </li>
@endforeach
</ul>