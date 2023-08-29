@extends('admin-panel.layout.one')
@section('title', 'Role Permission')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Role</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Role & Permission</li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
    <div class="row mb-3 d-flex justify-content-end ">
        <div class="col-sm-3">
            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addrole"
                data-bs-original-title="Add new Role" title="Add Role"><i class="fa fa-plus"></i> Add New Role
            </button>
        </div>
        {{-- Modal is below coded at end ofsection --}}
    </div>
    <div class="row">
        @foreach ($roles as $role)
            <div class="col-xl-4 box-col-4">
                <div class="card">
                    <div class="job-search">
                        <div class="card-body">
                            <div class="d-sm-flex align-items-start"><img class="img-40 img-fluid m-r-20"
                                    src="../assets/images/job-search/1.jpg" alt="">
                                <div class="flex-grow-1">
                                    <h6 class="f-w-600"><a
                                            href="job-details.html">{{ Helper::roleName($role->name) }}</a><span
                                            class="badge badge-primary pull-right"></span></h6>
                                    <p></p>
                                    <ul class="rating">

                                    </ul>
                                </div>
                            </div>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


{{-- modal new role create --}}
<div class="modal fade" id="addrole" tabindex="-1" aria-labelledby="addrole" style="display: none;"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Role</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                            data-bs-original-title="" title=""></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route(Helper::getGuard().
                        '.role-permission.role.store') }}" method="post"
                            class="needs-validation" novalidate="">
                            @csrf
                            <label class="form-label" for="role_name">Role Name</label>
                            <input class="form-control" name="role" id="role_name" type="text"
                                placeholder="Role  Name" required="" data-bs-original-title="Role Name" title="">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal" data-bs-original-title=""
                            title="">Close</button>
                        <button class="btn btn-primary" type="submit" data-bs-original-title="" title="">Add
                            Role</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
