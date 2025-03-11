<div class="preloader" id="preloader">
    <div class="preloader">
        <div class="waviy position-relative">
            @foreach(str_split($preloader_text) as $char)
                <span class="d-inline-block text-uppercase">{{ $char }}</span>
            @endforeach
        </div>
    </div>
</div>