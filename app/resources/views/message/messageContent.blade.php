@php($contents = explode("\n", $message->content))
@foreach($contents as $content)
    {{ $content }}
    @if($loop->index !== $loop->count - 1)
        <br>
    @endif
@endforeach
