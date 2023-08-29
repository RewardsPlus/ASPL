@extends('admin-panel.layout.one')
@section('title', 'QR Code')
@section('bread-crumb')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>QR Code</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">QR Code</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content-area')
<div class="card">
    <div class="card-header pb-0">
        <h6>QR Code List</h6>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead class="bg-primary">
                <tr>
                    <th>Code</th>
                    {{-- <th>Name</th>
                    <th>Title</th>
                    <th>QR Code</th>
                    <th>Description</th>
                    <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>

                @foreach($qRCodes as $qrCode)
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <svg width="200" height="200" xmlns="http://www.w3.org/2000/svg" class="float-end">
                                                <image href="{{asset('qr_codes/'.$qrCode->id.'.svg')}}" height="200" width="200" />
                                            </svg> 
                                        </div>
                                        <div class="col-6 d-flex align-items-center justify-content-space">
                                            <div class="row d-flex flex-column">
                                                <div class="col-4 w-100 pt-4">
                                                    {{$qrCode->name ?? ''}}
                                                </div>
                                                <div class="col-4 w-100 pt-4">
                                                    {{$qrCode->description ?? ''}}
                                                </div>
                                                <div class="col-4 w-100 pt-4">
                                                    {{$qrCode->created_at->format('M d Y') ?? ''}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 d-flex align-items-center ">
                                    <div class="row w-100 d-flex">
                                        <div class="col-6">
                                            <div class="row d-flex flex-column text-nowrap ">
                                                <div class="col-4 pt-4 text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid status_toggle middle sidebar-toggle">
                                                        <rect x="3" y="3" width="7" height="7"></rect>
                                                        <rect x="14" y="3" width="7" height="7"></rect>
                                                        <rect x="14" y="14" width="7" height="7"></rect>
                                                        <rect x="3" y="14" width="7" height="7"></rect>
                                                    </svg>
                                                </div>
                                                <div class="col-4 pt-4 text-center">
                                                    Total Scan  
                                                </div>
                                                <div class="col-4 pt-4 text-center">
                                                    {{$qrCode->view_count ?? 0}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row d-flex flex-column">
                                                <div class="col-4">
                                                    <a href="{{route('qrcodes.edit',$qrCode->id)}}" class="btn "> 
                                                        <i class="fa-solid fa-pen-to-square fa-xl"></i>
                                                    </a> 
                                                </div>
                                                <div class="col-4">
                                                    <a href="{{route('downloadqr',$qrCode->id)}}" class="btn "> 
                                                        <i class="fa-solid fa-file-arrow-down fa-xl"></i>
                                                    </a> 
                                                </div>
                                                <div class="col-4">
                                                    <form action="{{ route('qrcodes.destroy', $qrCode->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link">
                                                            <i class="fa-solid fa-trash fa-xl"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                    
            </tbody>

        </table>
            <div class="row">
                    {{ $qRCodes->links() }}
                <div class="col-6 float-end">
                </div>
            </div>
    </div>
</div>

@endsection
@section('script')

@endsection