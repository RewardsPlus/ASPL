@extends('admin-panel.layout.one')
@section('title', 'Company')
@section('bread-crumb')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>Store</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Company</li>
                    <li class="breadcrumb-item active">store</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content-area')
<div class="row mb-3 d-flex justify-content-end ">
    <div class="col-3">
        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addcompany"
            data-bs-original-title="Add new company" title="Add Company"><i class="fa fa-plus"></i> Add New Store
        </button>
    </div>
    {{-- Modal is below coded at end ofsection --}}

    <div class="col-3">
        <a class="btn btn-warning"
            href="@if(Route::has(Helper::getGuard().'.store.fetch-old-stores')){{ route(Helper::getGuard().'.store.fetch-old-stores') }}@endif"
            title="Add Company"><i class="fa fa-rotate-right"></i> Fetch Old data
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header pb-0">
        <h5>Store List</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="colble-responsive table-responsive">
                <table class="table table-bordered ">
                    <thead class="bg-primary">
                        <tr>
                            <th>Sr No</th>
                            <th>Store Name</th>
                            <th>Company Name</th>
                            <th>Store Email</th>
                            <th>Contact No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stores as $store)
                        <tr>
                            <td>{{ ($stores->currentPage()*10)+($loop->index + 1) }}</td>
                            <td>{{ $store->name??'' }}</td>
                            <td>{{ $store->company->name??'' }}</td>
                            <td>{{ $store->email??'' }}</td>
                            <td>{{ $store->mobile??'' }}</td>
                            <td>
                                <div class="d-flex">
                                <a class="btn btn-primary store_route" href="#" data-url="{{route('admin.store.edit',$store->id)}}" data-bs-toggle="modal" data-bs-target="#updatestore">Edit</a>
                                <form action="{{ route('admin.store.destroy',$store->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-primary">Delete</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="row mt-2">
            {{ $stores->links("pagination::bootstrap-5") }}
        </div>
    </div>
</div>

{{-- Modal for add Company --}}
<div class="modal fade" id="addcompany" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addcompany"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Store</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.')}}" method="post">
                    @csrf
                    <div class="col-12 p-0">
                        <!-- store Name -->
                        <div class="form-group">
                            <div class="col-12 d-flex flex-wrap">
                                <div class="col-12 d-flex">
                                    <div class="col-4 p-1">
                                        <label for="example_input_full_name">Country:</label>
                                        <div class="selectdiv">
                                            <select class="form-control" id="country_id" name="country_id">
                                                <option value="">Select Type</option>
                                                <option value="100">India </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 p-1">
                                        <label for="example_input_full_name">State:</label>
                                        <div class="selectdiv">
                                            <select class="form-control" id="state_id" name="state_id">
                                                <option value="">Select Type</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4 p-1">
                                        <label for="example_input_full_name">City:</label>
                                        <div class="selectdiv">
                                            <select class="form-control" id="city_id" name="city_id">
                                                <option value="">Select Type</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="example_input_full_name">Store Name :</label>
                                    <input type="text" name="store_name" id="store_name" placeholder="Ex: Store One"
                                        class="form-control">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Set Store Url
                                        :<small>https://store.rewardsplus.in/store/</small></label>
                                    <input type="text" name="store_url" id="store_url" placeholder="store-one"
                                        class="form-control " onblur="check_storeurl()">
                                    <label>REMINDER : The URL extension which you are setting up should be unique and
                                        easy
                                        to remember. This URL will be final and you would not be able to change it
                                        later.</label>
                                    <div id="urlCheck"></div>
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Pincode :</label>
                                    <div class="selectdiv">
                                        <select class="form-control pincode select2-hidden-accessible"
                                            id="m_select2_pincode" name="pincode" multiple=""
                                            data-select2-id="m_select2_pincode" tabindex="-1" aria-hidden="true">
                                            <option value=""> Select Pincode</option>
                                        </select>
                                        <!-- <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 544.175px;">
                                        <span class="selection">
                                            <span class="select2-selection select2-selection--multiple"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="-1">
                                                    <ul class="select2-selection__rendered">
                                                        <li class="select2-search select2-search--inline"><input
                                                                class="select2-search__field" type="search" tabindex="0"
                                                                autocomplete="off" autocorrect="off"
                                                                autocapitalize="none" spellcheck="false" role="textbox"
                                                                aria-autocomplete="list" placeholder="Select Pincode"
                                                                style="width: 542.575px;"></li>
                                                    </ul>
                                                </span>
                                            </span>
                                            <span class="dropdown-wrapper"
                                                aria-hidden="true">
                                            </span>
                                            </span> -->
                                    </div>
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Address :</label>
                                    <input type="text" name="address" id="address" placeholder="Address"
                                        class="form-control ">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Latitude:</label>
                                    <input class="form-control" id="lat" name="lat" placeholder="Latitude" type="text">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Longitude :</label>
                                    <input type="text" name="lon" id="lon" placeholder="Longitude" class="form-control">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">City Name :</label>
                                    <input type="text" name="city_name" id="city_name" placeholder="City Name"
                                        class="form-control">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Email:</label>
                                    <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Store Contact Number:</label>
                                    <input type="text" name="contact" id="contact" placeholder="Telephone/Mobile Number"
                                        class="form-control">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Password:</label>
                                    <input type="password" name="password" id="password" placeholder="Enter Password"
                                        class="form-control">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Store Code:</label>
                                    <input type="text" name="code" id="code" placeholder="Code" class="form-control">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Store Manager:</label>
                                    <input type="text" name="manager" id="manager" placeholder="Manager"
                                        class="form-control">
                                </div>
                                <div class="form-group  col-6 p-1">
                                    <label for="example_input_full_name">Photo:</label>
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Ratting:</label>
                                    <input type="text" class="form-control" id="ratting" name="ratting">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">GST No:</label>
                                    <input type="text" class="form-control" id="gst_no" name="gst_no">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Coupon Code:</label>
                                    <input type="text" class="form-control" id="coupon_code" name="coupon_code">
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Store Verification::</label>
                                    <div class="selectdiv">
                                        <select class="form-control" id="is_verified" name="is_verified">
                                            <option value="2">Not Verify</option>
                                            <option value="1">Verify</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-6 p-1">
                                    <label for="example_input_full_name">Company Name::</label>
                                    <div class="selectdiv">
                                        <select class="form-control" id="is_verified" name="company_name">
                                            <option>Select Company Name</option>
                                            @foreach($company as $company)
                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Store</button>
                        </div>
                    </div>
                </form>
            </div>



        </div>
    </div>
</div>

<div class="modal fade" id="updatestore" data-bs-backdrop="static" tabindex="-1" aria-labelledby="updatestore"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Store</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                    data-bs-original-title="" title=""></button>
            </div>
            <div class="modal-body inerhtml">
                
            </div>
        </div>
    </div>
</div>

@endsection
@section('script-area')
<script>
$(document).ready(function() {
    $(document).on('click', '.store_route', function() {
        $.ajax({
            url: $(this).data('url'),
            method: 'get',
            success: function(data) {
                $('.inerhtml').html(data);
                $('#updatestore').modal('open');
            }
        });
    });
});
</script>
@endsection