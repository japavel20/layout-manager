@props([
    'heading',
    'body',
    'cardFooterLeft',
    'cardFooterCenter',
    'cardFooterRight'
])

<div {{ $attributes->class(['card bg-white border-0 rounded-3 mb-4']) }}>
    {{-- @isset($heading)
    <div {{ $heading->attributes->class(['card-header bg-teal-800 text-white header-elements-inline']) }}>
        <h6 class="card-title">{{ $heading }}</h6>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item ui-sortable-handle" data-action="move"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
                <a class="list-icons-item" data-action="fullscreen"></a>
            </div>
        </div>
    </div>
    @endisset --}}

    @isset($body)
    <div {{ $body->attributes->class(['card-body p-4']) }}>
        {{ $body }}
    </div>
    @endisset
    
    <footer class='card-footer d-flex justify-content-between' >
        <div>{{ $cardFooterLeft ?? "" }}</div>
        <div>{{ $cardFooterCenter ?? "" }}</div>
        <div>{{ $cardFooterRight ?? "" }}</div>
    </footer>
</div>     