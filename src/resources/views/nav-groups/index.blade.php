<x-theme-master>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Nav Group</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Navigation</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Nav Group</span>
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
                <a href="{{route('nav-groups.create')}}" class="btn btn-outline-primary py-1 px-2 px-sm-4 fs-14 fw-medium rounded-3 hover-bg">
                    <span class="py-sm-1 d-block">
                        <i class="ri-add-line d-none d-sm-inline-block fs-18"></i>
                        <span>Add New Nav Group</span>
                    </span>
                </a>
            </div> 

            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Title</th>
                                <th scope="col">Parent Group</th>
                                <th scope="col">Total Nav Item</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Position</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($navGroups as $navGroup)
                                    <td class="text-body">{{ $loop->iteration }}</td>
                                    <td>{{ $navGroup->title }}</td>
                                    <td>{{ $navGroup->parent }}</td>
                                    <td>{{ $navGroup->total_nav_item }}</td>
                                    <td>{{ $navGroup->icon }}</td>
                                    <td>{{ $navGroup->position }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <a href="{{route('nav-groups.show', $navGroup->uuid)}}"><i class="material-symbols-outlined fs-16 text-primary">visibility</i></a>
                                            </button>
                                            <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                <a href="{{route('nav-groups.edit', $navGroup->uuid)}}">
                                                    <i class="material-symbols-outlined fs-16 text-body">edit</i>
                                                </a>
                                            </button>
                                            <form action="{{ route('nav-groups.destroy', $navGroup->uuid) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE') 
                                                
                                                <button type="submit" onclick="return confirm('{{ __('Are you sure?') }}')" 
                                                    class="ps-0 border-0 bg-transparent lh-1 position-relative top-2">
                                                    <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                                </button>
                                            </form>
                                        </div>
                                    </td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                    <!-- Items Per Page Dropdown -->
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

                    <!-- Pagination Info and Links -->
                    <div class="d-flex align-items-center">
                        <span class="fs-13 fw-medium me-2">
                            {{ $navGroups->firstItem() }} - {{ $navGroups->lastItem() }} of {{ $navGroups->total() }}
                        </span>

                        {{ $navGroups->appends(['per_page' => request('per_page', 10)])->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-theme-master>