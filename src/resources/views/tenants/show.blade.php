<x-theme-master>
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
			<p><b>{{ __('Title') }} : </b> {{ $navItem->title }}</p>
			<p><b>{{ __('Icon') }} : </b> {{ $navItem->icon }}</p>
			<p><b>{{ __('Position') }} : </b> {{ $navItem->position }}</p>
        </div>
    </div>
@push('css')
{{--pagespecific-css--}}
@endpush

@push('js')
{{--pagespecific-js--}}
@endpush
</x-theme-master>