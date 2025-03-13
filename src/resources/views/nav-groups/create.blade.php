<x-theme-master>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Nav Group Create</h3>

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
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Create</span>
                </li>
            </ol>
        </nav>
    </div>
    
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('nav-groups.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Parent</label>
                            <div class="form-group position-relative">
                                <select class="form-select form-control ps-5 h-55" aria-label="Default select example" name="parent_id">
                                    @isset($tree_options)
                                        {!! $tree_options !!}
                                    @endisset
                                </select>
                                <i class="ri-list-ordered position-absolute top-50 start-0 translate-middle-y fs-20 ps-20"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Title</label>
                            <div class="form-group position-relative">
                                <input type="text" id="titleInput" name="title" :value="old('title')"  class="form-control text-dark ps-5 h-55" placeholder="Enter Title">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Icon</label>
                            <div class="form-group position-relative">
                                <input type="text" id="iconInput" name="icon" :value="old('icon')"  class="form-control text-dark ps-5 h-55" placeholder="Enter Icon Class">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Position</label>
                            <div class="form-group position-relative">
                                <input type="number" id="positionInput" name="position" :value="old('position')"  class="form-control text-dark ps-5 h-55" placeholder="Enter Position No">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="text-end gap-2">
                    <button type="submit" class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 fw-semibold py-2 px-4">Submit</button>
                    <button type="button" class="btn btn-danger bg-danger bg-opacity-10 text-danger border-0 fw-semibold py-2 px-4">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    
</x-theme-master>