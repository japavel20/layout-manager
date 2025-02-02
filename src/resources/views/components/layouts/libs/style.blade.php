@foreach($cssFiles as $cssFile)
    <link href="{{ $cssFile }}" rel="stylesheet" type="text/css" />
@endforeach

@foreach($imageFiles as $imageFile)
    <link href="{{ $imageFile }}" rel="icon" type="image/png" />
@endforeach

@stack('css')