<x-theme-master>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0"> Tenant Edit</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Tenant</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Tenant</span>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Edit</span>
                </li>
            </ol>
        </nav>
    </div>
    
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('tenants.update',$tenant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Name*</label>
                            <div class="form-group position-relative">
                                <input type="text" id="nameInput" name="name" value="{{ old('title',$tenant->name ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Domain</label>
                            <div class="form-group position-relative">
                                <input type="text" id="domainInput" name="domain" value="{{ old('domain',$tenant->domain ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Domain">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Database</label>
                            <div class="form-group position-relative">
                                <input type="text" id="databaseInput" name="database" value="{{ old('database',$tenant->database ?? '')}}"  class="form-control text-dark ps-5 h-55" placeholder="Enter Database Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Status</label>
                            <div class="form-group position-relative">
                                <select id="statusInput" name="status" class="form-control text-dark ps-5 h-55" required>
                                    <option value="Active" {{ $tenant->status === 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ $tenant->status === 'Anactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
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