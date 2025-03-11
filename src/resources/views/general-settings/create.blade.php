<x-theme-master>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0"> Crete Nav Item</h3>

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
                    <span class="fw-medium">Create</span>
                </li>
            </ol>
        </nav>
    </div>
    
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form method="post" action="{{route('general-settings.store')}}">
                @csrf
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Key</label>
                            <div class="form-group position-relative">
                                <select class="form-select form-control ps-5 h-55" aria-label="Default select example" name="key" id="key" placeholder="Please Select Key">
                                    @foreach ($setups as $key => $setup)
                                        <option value="{{ $key }}">{{ $setup }}</option>
                                    @endforeach
                                </select>
                                <i class="ri-list-ordered position-absolute top-50 start-0 translate-middle-y fs-20 ps-20"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Value</label>
                            <div class="form-group position-relative">
                                <input type="text" name="value" id="value" value="{{old('value')}}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Path</label>
                            <div class="form-group position-relative">
                                <input type="text" name="path" value="{{old('path')}}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group row mb-4">
                            <label class="col-form-label">Image <code>(Optional)</code></label>
                            <div class="col-lg-5">
                                <input type="file" class="form-control" id="image">
                                <input type="hidden" class="form-control" id="image_b64">
                            </div>
                            <div class="col-lg-2">
                                <button type="button" id="img-upload"
                                    class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 fw-semibold py-2 px-4 p-6 mt-1">Upload</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-3">
                        <img src="{{ asset(old('value')) }}" alt="" id="image_preview" class="img-fluid">
                    </div>
                </div>

                <div class="text-end gap-2">
                    <button type="submit" class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 fw-semibold py-2 px-4">Submit</button>
                    <button type="submit" class="btn btn-danger bg-danger bg-opacity-10 text-danger border-0 fw-semibold py-2 px-4">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    @push('js')
    <script>
        $(document).on('change', '#image', image);
        $(document).on('click', '#img-upload', upload_image);

        // $('#key').select2({
        //     placeholder: "Choose Key",
        //     tags        : true
        // }).val(null).trigger('change');

        function image() 
        {
            if (this.files && this.files[0]) 
            {
                var FR= new FileReader();
                FR.addEventListener("load", function(e) {
                    $(document).find('#image_b64').val(e.target.result);
                    $(document).find('#image_preview').attr('src', e.target.result);
                }); 
                FR.readAsDataURL( this.files[0] );
            }
        }

        function upload_image()
        {
            let 
                el              = $(this);

            $.ajax({
                url         : '/general-settings/api/upload-image',
                method      : 'POST',
                dataType    : 'json',
                data        : {"image_b64" : $("#image_b64").val()},
                headers: {
                    "X-CSRF-TOKEN": $('input[name="_token"]').val()
                },
                beforeSend  :function() {
                    el.html(`<i class="icon-spinner2 spinner"></i> LOADING...`).prop('disabled', true);
                },
                success     : function(res, stage, info){
                    $(document).find('#value').val('storage/'+res.data).prop('readonly', true);
                    el.html(`Upload`).prop('disabled', true);
                },
                error       : function(err){
                    el.html(`Upload`).prop('disabled', false);
                }
            });
        }

    </script>
    @endpush
    
</x-theme-master>