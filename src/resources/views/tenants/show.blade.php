<x-theme-master>
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
			<p><b>{{ __('Title') }} : </b> {{ $tenant->name }}</p>
			<p><b>{{ __('Icon') }} : </b> {{ $tenant->domain }}</p>
			<p><b>{{ __('Position') }} : </b> {{ $tenant->database }}</p>
        
            @if(count($tenant->users))

            <h3 class="mt-4 text-center text-uppercase mb-3"><strong>{{ __('Users') }}</strong></h3>

            <table class="table">
                <thead class="bg-teal-800">
                    <tr>
                    <th class="text-center">{{ __('Name') }}</th>
                    <th class="text-center">{{ __('Email') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tenant->users as $user)
                    <tr>
                        <td class="text-center">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->email }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    
    @push('css')
    {{--pagespecific-css--}}
    @endpush

    @push('js')
    {{--pagespecific-js--}}
    @endpush
</x-theme-master>