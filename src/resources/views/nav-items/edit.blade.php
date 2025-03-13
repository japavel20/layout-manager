<x-theme-master>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0"> Crete Nav Edit</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Navigation</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Nav Item</span>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Edit</span>
                </li>
            </ol>
        </nav>
    </div>
    
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('nav-items.update',$navItem->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Title</label>
                            <div class="form-group position-relative">
                                <input type="text" id="titleInput" name="title" value="{{ old('title',$navItem->title ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Title">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Url</label>
                            <div class="form-group position-relative">
                                <input type="text" id="urlInput" name="url" value="{{ old('title',$navItem->url ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Url">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Icon</label>
                            <div class="form-group position-relative">
                                <input type="text" id="iconInput" name="icon" value="{{ old('title',$navItem->icon ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Icon Class">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Position</label>
                            <div class="form-group position-relative">
                                <input type="number" id="positionInput" name="position" value="{{ old('title',$navItem->position ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Position No">
                            </div>
                        </div>
                    </div>

                    @php $options = ['direct-link'=>'Direct Link','drop-down'=>'Drop Down','component'=>'Components'] @endphp
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Menu Type</label>
                            <div class="form-group position-relative">
                                <select class="form-select form-control ps-5 h-55" aria-label="Default select example" name="menu_type" id="menu_typeInput" placeholder="Please Select Type">
                                    @foreach ($options as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                <i class="ri-list-ordered position-absolute top-50 start-0 translate-middle-y fs-20 ps-20"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Label</label>
                            <div class="form-group position-relative">
                                <input type="text" id="labelInput" name="label" value="{{ old('title',$navItem->label ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Label">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Tooltip</label>
                            <div class="form-group position-relative">
                                <input type="text" id="tooltipInput" name="tooltip" value="{{ old('title',$navItem->tooltip ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Toltip">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="text-end gap-2">
                    <button type="submit" class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 fw-semibold py-2 px-4">Submit</button>
                    <button type="submit" class="btn btn-danger bg-danger bg-opacity-10 text-danger border-0 fw-semibold py-2 px-4">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    
</x-theme-master>