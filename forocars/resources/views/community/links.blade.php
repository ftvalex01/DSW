@if(count($links) === 0)
    
<p>No approved contributions yet</p>

@endif
@foreach ($links as $link)

<li>
    <a href="{{ $link->link }}" target="_blank">
        {{ $link->title }}
    </a>
    <span class="label label-default" style="background: {{ $link->channel->color }}">
        {{ $link->channel->title }}
        
        </span>
    <small>Contributed by: {{ $link->creator->name }} {{ $link->updated_at->diffForHumans() }}</small>
</li>

@endforeach