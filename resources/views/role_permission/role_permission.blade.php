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

    <div class="card">
        
        <div class="card-header pb-0">
            <h6>Roles</h6>
        </div>
        <div class="card-body">
                <form action="{{ route(Helper::getGuard().'.role-permission.fetch-permissions') }}" method="POST" id="fetchpermission">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                                    <div class="input-field">
                                        <select class="form-select"  name="role">
                                          @foreach ($roles as $r)
                                              <option value="{{$r->id}}" @isset($role)@selected($role->id==$r->id) @endisset>{{Helper::roleName($r->name)}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                 
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" id="btn-btn" type="submit">Fetch Permissions</button>
                        </div>
                                 
                                
                    </div>
                       
                              
                </form>
        </div>
    </div>


<div id="assignpermission"></div>


@endsection
@section('script-area')
<script>
    $(document).on('submit','#fetchpermission',function(e){
      e.preventDefault(); 
      $.ajax({
        url:$('#fetchpermission').attr('action'),
        method:'post',
        data:$('#fetchpermission').serialize(),
        success:function(res){
            $('#assignpermission').html(res);
        }
      });
    });
    $(document).ready(function(){
        @isset($role)
        $('#fetchpermission').submit();
        @endisset
       $(document).on('click','.filled-in',function(){
       $(this).closest('tr').children('td:first').children('label').children('input').attr('checked','');
           });
    });
</script>
@endsection