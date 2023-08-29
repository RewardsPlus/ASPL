@extends('admin-panel.layout.one')
@section('title', 'Company')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Company</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Company</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
    <div class="row mb-3 d-flex justify-content-end ">
        <div class="col-sm-3">
            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addcompany"
                data-bs-original-title="Add new company" title="Add Company"><i class="fa fa-plus"></i> Add New Comapny
            </button>
        </div>
        {{-- Modal is below coded at end ofsection --}}

        <div class="col-sm-3">
            <a class="btn btn-warning" href="{{ route('admin.company.fetch-old-companies') }}" title="Add Company"><i class="fa fa-rotate-right"></i> Fetch Old data
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header pb-0">
            <h5>Company List</h5>
        </div>
        <div class="card-body">
            <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <thead class="bg-primary">
                    <tr>
                        <th>Sr No</th>
                        <th>Name</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                    <tr>
                        <td>{{ (($companies->currentPage()-1)*10)+($loop->index + 1) }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->company_detail->company_name??'' }}</td>
                        <td>{{ $company->email }}</td>
                        <td class="d-flex gap-2">
                            <button class="btn btn-outline-info-2x btn-square edit-company-btn" data-id="{{ $company->id  }}"><i class="fa fa-pencil-square-o"></i></button>
                            <form action="{{ route('admin.company.destroy',$company->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-outline-danger-2x btn-square"><i class="fa fa-trash-o"></i></button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mt-2">
                {{ $companies->links("pagination::bootstrap-5") }}
            </div>
        </div>
    </div>
        </div>
    </div>

    {{-- Modal for add Company --}}
    <div class="modal fade" id="addcompany" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addcompany" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Company</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-original-title="" title=""></button>
                </div>

                <form method="POST" action="{{ route('admin.company.store') }}" accept-charset="UTF-8"
                    class="m-form" enctype="multipart/form-data" novalidate="novalidate">
                    <div class="modal-body">
                        @csrf
                        <div class="card">

                            <!-- company Name -->

                            <div class="card-body ">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="company_name">
                                            Company* :
                                        </label>
                                        <input class="form-control m-input" id="company_name" name="company_name"
                                            placeholder="Your Company Name" type="text">
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="name">
                                            Name* :
                                        </label>
                                        <input class="form-control " id="name" name="name" placeholder="Your Name"
                                            type="text">
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="email">
                                            Email* :
                                        </label>
                                        <input type="text" name="email" id="email" placeholder="Enter the Email"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mobile">
                                            Phone* :
                                        </label>
                                        <input type="text" name="mobile" id="mobile" placeholder="Enter phone no:"
                                            class="form-control">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="password">
                                            Password* :
                                        </label>
                                        <input type="password" name="password" id="password" class="form-control m-input">
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="i_cat">
                                            Industry Category* :
                                        </label>
                                        <select class="form-control " id="i_cat" name="i_cat" required>
                                            <option value="">Select Type</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group m-form__group col-md-6">
                                        <label for="example_input_full_name">
                                            Industry Sub Category* :
                                        </label>
                                        <select class="form-control m-input" id="i_subcat" name="i_subcat">
                                            <option value="">Select Type</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group m-form__group col-md-6">
                                        <label for="example_input_full_name">
                                            Business Type* :
                                        </label>
                                        <select class="form-control m-input" id="business_type" name="business_type">
                                            <option value="" selected disabled>Select Type</option>
                                            @foreach ($businesstypes as $bt)
                                                <option value="{{ $bt->id }}">{{ $bt->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- roles -->
                    </div>

                    <div class="modal-footer">
                        <div class="row w-50">
                            <div class="col">
                                <button type="submit" class="btn btn-success">
                                    Add New Company
                                </button>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger" type="button"  data-bs-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>

                    <!-- </form> -->

                </form>

            </div>
        </div>
    </div>

    {{-- Edit company --}}
    <div class="modal fade" id="editcompany" data-bs-backdrop="static" tabindex="-1" aria-labelledby="editcompany" style="display: none;"
aria-hidden="true">
</div>
            @endsection

            @section('script-area')
                <script>
                    $(document).on('change', '#i_cat', function() {
                        var id = $(this).val();
                        $.ajax({
                            url: "{{ route('admin.company.subcategory') }}",
                            method: 'post',
                            data: {
                                'category_id': id,
                                'reqtype': 'op',
                                '_token': "{{ csrf_token() }}"
                            },
                            beforeSend: function() {
                                $('#i_cat').attr('disabled', true);
                            },
                            success: function(data) {
                                $('#i_subcat').html(data);
                                $('#i_cat').removeAttr('disabled');
                            }


                        });
                    });
                    $(document).on('change', '#i_cat_edit', function() {
                        var id = $(this).val();
                        $.ajax({
                            url: "{{ route('admin.company.subcategory') }}",
                            method: 'post',
                            data: {
                                'category_id': id,
                                'reqtype': 'op',
                                '_token': "{{ csrf_token() }}"
                            },
                            beforeSend: function() {
                                $('#i_cat_edit').attr('disabled', true);
                            },
                            success: function(data) {
                                $('#i_subcat_edit').html(data);
                                $('#i_cat_edit').removeAttr('disabled');
                            }


                        });
                    });
                    $(document).on('click','.edit-company-btn',function(){
                        var id=$(this).data('id');
                        $.ajax({
                            url:"{{ url('company') }}/"+id+'/edit',
                            method:'get',
                            success:function(res){
                               $('#editcompany').html(res);
                               $('#editcompany').modal('show');
                            },
                        });
                    });
                </script>
            @endsection
