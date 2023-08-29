@extends('admin-panel.layout.one')
@section('title', 'Company')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Leave</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Employee</li>
                        <li class="breadcrumb-item active">leave</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
<div class="row mb-3 d-flex justify-content-end ">
    <div class="col-sm-3">
        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#leavemodal"
            data-bs-original-title="Add new employee" title="Add employee"><i class="fa fa-plus"></i> Apply Leave
        </button>
    </div>
    {{-- Modal is below coded at end ofsection --}}
</div>

<div class="card">
    <div class="card-header pb-0">
        <h6>Leave List</h6>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead class="bg-primary">
                <tr>
                    <th>Sr No.</th>
                    <th>Subject</th>
                    <th>Leave From</th>
                    <th>Leave To</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaves as $key => $leave)
                    <tr>
                        <td>{{ $loop->index+1}}</td>
                        <td>{{ $leave->subject }}</td>
                        <td>{{Carbon\Carbon::parse($leave->leave_start)->format('d-m-Y') }}</td>
                        <td>{{ Carbon\Carbon::parse($leave->leave_end)->format('d-m-Y') }}</td>
                        @php
                        $color='';
                           if($leave->status==App\Models\Leave::$pending){
                            $color="warning";
                           }
                           else if($leave->status==App\Models\Leave::$rejected) {
                            $color="danger";
                           } 
                           else if($leave->status==App\Models\Leave::$approved)
                           {
                            $color="success";
                           }
                        @endphp
                        <td class="text-{{ $color }}">{{ $leave->status }}</td>
                    </tr>
                @endforeach

                    
            </tbody>
        </table>
    </div>
    {{ $leaves->links('pagination::bootstrap-5') }}
</div>


{{-- // Leave Modal --}}
<!-- Modal -->
<div class="modal fade" id="leavemodal" tabindex="-1" aria-labelledby="leavemodallabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="leavemodallabel">Apply for leave</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route(Helper::getGuard().'.leave.store') }}" method="post">
            @csrf
            <div class="modal-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="from">Leave From</label>
                    <input type="date" name="from" id="from" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="to">Leave To</label>
                    <input type="date" name="to" id="to" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="description">Description</label>
                    <textarea name="desc" id="" cols="30" rows="3" class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Apply  Leave</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section('script')

@endsection