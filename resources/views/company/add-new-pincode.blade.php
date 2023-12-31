@extends('admin-panel.layout.one')
@section('title', 'Company-attendance')
@section('link-area')
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
 --}}
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Pincode Delivery Setup</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Company</li>
                        <li class="breadcrumb-item ">Delivery</li>
                        <li class="breadcrumb-item active">Pincode</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h6>Add new pincode</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
           <div class="container-fluid">
                <form action="/delivery/pincode/save-new-pincode" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="store">Select Store</label>
                            <select name="store_id" id="store" class="form-select w-50">
                                <option value="" selected hidden>--Select--</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}" {{ ( count($stores) == 1) ? 'selected' : '' }}>{{ $store->name }} ( {{$store->detail->code}} )</option>
                                @endforeach
                            </select>
                            @error('store')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="pincode">
                                Pincode:
                            </label>
                            <input type="text" name="pincode" id="pincode" placeholder="Enter Pincode"
                                class="form-control" required>
                            @error('pincode')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="min_day">
                                Min. Days:
                            </label>
                            <input type="number" name="min_days" id="min_day" placeholder="Mimimum days"
                                class="form-control" required>
                            @error('min_day')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="max_days">
                                Max. Days:
                            </label>
                            <input type="number" name="max_days" id="max_days" placeholder="Maximum days"
                                class="form-control" required>
                            @error('max_days')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="pickup_time">
                                Pickup Time:
                            </label>
                            <input type="time" name="pickup_time" id="pickup_time" placeholder="Courier pickup time"
                                class="form-control" required>
                            @error('pickup_time')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
           </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12">
                    <h6>CSV Bulk Upload</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
           <div class="container-fluid">
                <form action="/delivery/pincode/csv-upload" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="store">Select Store</label>
                            <select name="store_id" id="store" class="form-select">
                                <option value="" selected hidden>--Select--</option>
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}" {{ ( count($stores) == 1) ? 'selected' : '' }}>{{ $store->name }} ( {{$store->detail->code}} )</option>
                                @endforeach
                            </select>
                            @error('store')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="csv">
                                CSV file:
                            </label>
                            <input type="file" name="csv" id="csv" placeholder="CSV file"
                                class="form-control" required>
                            @error('csv')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
           </div>
        </div>
    </div>


@endsection
@section('content-area')
@endsection


@section('script-area')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    @if(Session::has('store_id'))
    initializeDataTable();
    @endif
  // Bind change event listener to the dropdown
  $(document).on('change','#store', function() {
    // Re-initialize DataTable when dropdown value changes
    initializeDataTable();
  });
});
function initializeDataTable() {
    var selectedValue = $('#store').val();

// Destroy existing DataTable (if any)
if ($.fn.DataTable.isDataTable('.data-table')) {
  $('.data-table').DataTable().destroy();
}



    $(function () {

      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          searching: true,
          ajax: {
            url:"{{ route('company.delivery.pincode') }}",
            type:'get',
            data:{
                'store_id':selectedValue
            }
          },
          columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'pincode', name: 'pincode',searchable: true},
              {data:'delivery_time',name:'delivery_time'},
          ],
      });

    });
    // Reinitialize Bootstrap dropdowns
    $(document).on('click', '.dropdown-toggle', function() {
        $(this).dropdown('toggle');
    });
}

  </script>

@endsection
