<x-theme-master>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">General Settings</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Navigation</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">General Settings</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-lg-4 mb-3">
                <form class="position-relative table-src-form me-0">
                    <input type="text" class="form-control" placeholder="Search here">
                    <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y">search</i>
                </form>
                <a href="{{route('general-settings.create')}}" class="btn btn-outline-primary py-1 px-2 px-sm-4 fs-14 fw-medium rounded-3 hover-bg">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line d-none d-sm-inline-block fs-18"></i>
                        <span>Add New General Settings</span>
                    </span>
                </a>
            </div> 

            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">Key</th>
                                <th scope="col">Value</th>
                                <th scope="col">Path</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($setups as $setup)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $setup->key }}</td>
                                    <td>{{ $setup->value }}</td>
                                    <td>{{ $setup->path }}</td>
                                    <td class="d-flex">
                                        <div class="d-flex align-items-center gap-1">
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <a href="{{route('general-settings.show', $setup->id)}}"><i class="material-symbols-outlined fs-16 text-primary">visibility</i></a>
                                            </button>
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <a href="{{route('general-settings.edit', $setup->id)}}">
                                                    <i class="material-symbols-outlined fs-16 text-body">edit</i>
                                                </a>
                                            </button>
                                            <form action="{{ route('general-settings.destroy', $setup->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE') {{-- Spoof DELETE request --}}
                                                
                                                <button type="submit" onclick="return confirm('{{ __('Are you sure?') }}')" 
                                                    class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                    <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                     
                                        {{-- <x-sg-link-show href="{{route('organization-setups.show', $setup->uuid)}}" />
                                        <x-sg-link-edit href="{{route('organization-setups.edit', $setup->uuid)}}" />
                                        <x-sg-btn-delete action="{{route('organization-setups.destroy', $setup->uuid)}}" method="post" />
                                        --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                    <form method="GET" class="d-flex align-items-center">
                        <label for="per_page" class="fs-13 fw-medium me-2">Items per page:</label>
                        <select name="per_page" id="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            @foreach([5, 10, 20, 50, 100] as $size)
                                <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                    {{ $size }}
                                </option>
                            @endforeach
                        </select>
                    </form>

                    <div class="d-flex align-items-center">
                        <span class="fs-13 fw-medium me-2">
                            {{ $setups->firstItem() }} - {{ $setups->lastItem() }} of {{ $setups->total() }}
                        </span>
                        {{ $setups->appends(['per_page' => request('per_page', 10)])->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    <style>
        .pagination {
            margin:0px !important;
            padding:0px !important;
            margin-left: 8px !important;
        }
    </style>
    @endpush

</x-theme-master>