{{-- <link rel="shortcut icon" href="{{ asset($icon) }}"> --}}
@foreach($favicons as $favicon)
    <link href="{{ $favicon }}" rel="icon" type="image/png" />
@endforeach