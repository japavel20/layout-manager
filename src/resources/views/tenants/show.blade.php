<x-theme-master>
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
			<p><b>{{ __('Title') }} : </b> {{ $tenant->name }}</p>
			<p><b>{{ __('Icon') }} : </b> {{ $tenant->domain }}</p>
			<p><b>{{ __('Position') }} : </b> {{ $tenant->database }}</p>
        </div>
    </div>
@push('css')
{{--pagespecific-css--}}
@endpush

@push('js')
{{--pagespecific-js--}}
@endpush
</x-theme-master>