<div id="jsLibContainer">
    @foreach($jsFiles as $jsFile)
    <script src="{{ $jsFile }}"></script>
    @endforeach
    @stack('js')
</div>