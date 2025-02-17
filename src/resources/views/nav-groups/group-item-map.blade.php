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
            <form action="{{ route('nav-group-item-map.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Navgroup</label>
                            <div class="form-group position-relative">
                                <select class="form-select form-control ps-5 h-55 select-section" aria-label="Default select example" name="navgroup_id" id="navgroup_idsInput">
                                    
                                </select>
                                <i class="ri-list-ordered position-absolute top-50 start-0 translate-middle-y fs-20 ps-20"></i>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <h4 class="col-12">Nav Items</h4>
                    <div class="col-12" id="nav-items">

                    </div>
                    <div class="text-end gap-2">
                        <button type="submit" class="btn btn-primary bg-primary bg-opacity-10 text-primary border-0 fw-semibold py-2 px-4">Submit</button>
                        <button type="submit" class="btn btn-danger bg-danger bg-opacity-10 text-danger border-0 fw-semibold py-2 px-4">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('css')
    {{--pagespecific-css--}}
    @endpush

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            (function($){
                $(document).ready(()=>{
                    $('.select-section').select2();
                    $(document).on('change','#navgroup_idsInput',loadNavItems);                
                });
            })(jQuery)

            const loadNavItems = (event)=>{
                let el = event.target;

                locatinId = $(el).val();

                $("#nav-items").html('');
                if(locatinId != null){
                    $.ajax({
                        url      : `/api/get-nav-items-with-selected/${locatinId}`,
                        method   : "GET",
                        dataType : "JSON",
                        success     : function (res)
                        {
                            let contentHolder = ''; 
                            $.each(res,function(index,val){
                                if(val.isSelected != 0){
                                    contentHolder += `<input type="checkbox" value="1" checked name=navItems[${val.id}] id=${val.id}><label class="mr-4" for=${val.id}>${val.title}</label>`;
                                }else
                                {
                                    contentHolder += `<input type="checkbox" value="1" name=navItems[${val.id}] id=${val.id}><label class="mr-4" for=${val.id}>${val.title}</label>`;
                                }
                            });

                            $("#nav-items").html(contentHolder);

                        },
                        error(err){
                            $("#nav-items").html('');
                        }
                    }); 
                }
            }

        </script>
    @endpush
    
</x-theme-master>