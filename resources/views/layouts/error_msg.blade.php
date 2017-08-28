@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        <div class="note note-{{ $msg }}">
            <p>{{ Session::get('alert-' . $msg) }}</p>
        </div>
    @endif
@endforeach