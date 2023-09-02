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
                <div class="col-8">
                    <h6>Delivery Setup</h6>
                </div>
                <div class="col-4">
                    <label for="store">Select Store</label>
                    <select name="store" id="store" class="form-select">
                        <option value="" selected hidden>--Select disabled--</option>
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}" @selected(Session::get('store_id')==$store->id)>{{ $store->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered data-table">
                <thead class="bg-primary">
                    <tr>
                        <th>Sr.No</th>
                        <th>Pincode</th>
                        <th>Delivery Time (Min day, Max day, Shipment Pickup Time)</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
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
