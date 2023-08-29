@extends('admin-panel.layout.one')
@section('title','Permission')
@section('bread-crumb')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h3>Permission</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Role & Permission</li>
                    <li class="breadcrumb-item active">Permission</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content-area')
<div class="row mb-3 d-flex justify-content-end ">
    <div class="col-sm-3">
        <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addpermisison"
            data-bs-original-title="Add new Permission" title="Add Permission"><i class="fa fa-plus"></i> Add New Permission
        </button>
    </div>
    {{-- Modal is below coded at end ofsection --}}
</div>
<div class="card">
    <div class="card-header">
        <h5>Permission List</h5>

    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="bg-primary">
                <tr>
                    <th>Sr No</th>
                    <th>Permission Name</th>
                    <th>Guard</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $per)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $per->permission_name }}</td>
                        <td>{{ $per->guard_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



{{-- Modal for Permission Add --}}
<div class="modal fade" id="addpermisison" tabindex="-1" aria-labelledby="addpermisison" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route(Helper::getGuard().'.role-permission.permission.store') }}" method="post">
                        @csrf
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Permission Name</label>
                                <input type="text" class="form-control" name="permission">
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title=""
                                title="">Close</button>
                            <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Add Permission</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
