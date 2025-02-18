<div id="jsLibContainer">
    @foreach($jsFiles as $jsFile)
    <script src="{{ $jsFile }}"></script>
    @endforeach
    <!-- Core JS files -->
    <script id="jquery" src="{{ asset('/themes') }}/global_assets/js/main/jquery.min.js"></script>
    <script id="select2" src="{{ asset('/themes') }}/global_assets/js/main/select2.min.js"></script>
    <script id="bootstrap_multiselect" src="{{ asset('/themes') }}/global_assets/js/main/bootstrap_multiselect.js"></script>
    @stack('js')
</div>