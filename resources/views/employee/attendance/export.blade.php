@extends('admin-panel.layout.one')
@section('title', 'Company-attendance')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Attendace</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Company</li>
                        <li class="breadcrumb-item active">attendance</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
<div class="card">
    <div class="card-body">
        <form action="{{ route(Helper::getGuard().'.attendance.bulk-attendance-get') }}">
            @csrf
            <div class="row">
                <div class="col-sm-3 form-group">
                    <label for="from"class="form-label">From</label>
                    <input type="date" class="form-control" name="from" id="from" @isset($filter['from']) value="{{ $filter['from']??'' }}" @endisset required>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="to"class="form-label">To</label>
                    <input type="date" class="form-control" name="to" id="to" @isset($filter['to']) value="{{ $filter['to']??'' }}" @endisset required>
                </div>
                <div class="col-sm-3 form-group">
                    <label for="status"class="form-label">Status</label>
                    <select name="status" id="" class="form-select">
                        <option value="" disabled selected hidden>Choose Status</option>
                            <option value="present" @isset($filter['status']) @selected($filter['status']=='present') @endisset >Present</option>
                            <option value="absent" @isset($filter['status']) @selected($filter['status']=='absent') @endisset >Absent</option>
                            <option value="paid-leave" @isset($filter['status']) @selected($filter['status']=='paid-leave') @endisset>Paid Leave</option>
                            <option value="unpaid-leave" @isset($filter['status']) @selected($filter['status']=='unpaid-leave') @endisset >Unpaid Leave</option>
                            <option value="half-day" @isset($filter['status']) @selected($filter['status']=='half-day') @endisset>half-day</option>
                        </select>
                    
                </div>
                <div class="col-sm-3 mt-4">
                    <button class="btn btn-primary btn-square" id="search_btn" name="submit" value="search"><i class="fa fa-search fa-2x"></i></button>
                    <button class="btn btn-success btn-square" id="search_btn" name="submit" value="excel"><i class="fa fa-file-excel-o fa-2x"></i></button>
                    <button class="btn btn-danger btn-square" id="search_btn" name="submit" value="consolidate-excel"><i class="fa fa-file-excel-o fa-2x"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h4></h4>
    </div>
    <div class="card-body">
       <table class="table table-bordered">
        <thead class="bg-primary">
            <tr>
                <th>Sr. No</th>
                <th>Name</th>
                <th>Employee Id</th>
                <th>Store Code</th>
                <th>Date</th>
                <th>Clock-In</th>
                <th>Clock-Out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ (($attendances->currentPage()-1)*10)+$loop->index+1 }}</td>
                    <td>{{ $attendance->employee->name }}</td>
                    <td>{{ $attendance->employee->uniqid }}</td>
                    <td>{{ $attendance->employee->store->detail->code }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-M-Y') }}</td>
                    <td>{{ $attendance->clock_in!=null?\Carbon\Carbon::parse($attendance->clock_in)->format('h:i'):'' }}</td>
                    <td>{{ $attendance->clock_out!=null?\Carbon\Carbon::parse($attendance->clock_out)->format('h:i'):'' }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @endforeach
        </tbody>
       </table>
    </div>
    {{ $attendances->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
</div>
@endsection