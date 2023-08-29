@extends('admin-panel.layout.one')
@section('title', 'Company')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Leave Applications</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Employee</li>
                        <li class="breadcrumb-item active">Leave-appications</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
<div class="card">
    <div class="card-header pb-0">
        <h6>Applications</h6>
    </div>
    <div class="card-body">
        <table class="table  table-bordered ">
            <thead class=" bg-primary">
                <tr>
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>Leave From</th>
                    <th>Leave To</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leave)
                <form action="{{ route(Helper::getGuard().'.employee.leave.status') }}" method="post">
                    @csrf
                    <input type="hidden" name="application_id" value="{{ $leave->id }}">
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $leave->leaveable->name }}</td>
                    <td>{{ $leave->leave_start }}</td>
                    <td>{{ $leave->leave_end }}</td>
                    <td>
                        <select name="status" id="" class="form-select"  onchange="this.form.submit()">
                            <option value="" selected hidden>Pending</option>
                            <option value="approved" @selected($leave->status=='approved')>Approve</option>
                            <option value="rejected" @selected($leave->status=='rejected')>Reject</option>
                        </select>
                    </td>
                </tr>
            </form>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection