<x-theme-master>
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <p><b>{{ __('KEY') }} : </b> {{ $setup->key }}</p>
                <p><b>{{ __('VALUE') }} : </b> {{ $setup->value }}</p>
                <p><b>{{ __('PATH') }} : </b> {{ $setup->path }}</p>
            </div>
        </div>
    </div>
@push('css')
{{--pagespecific-css--}}
@endpush

@push('js')
{{--pagespecific-js--}}
@endpush
</x-theme-master>