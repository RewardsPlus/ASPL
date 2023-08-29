
<div class="row">
    <div class="col-2"><b>Name</b></div>
    <div class="col-6">{{ $employee->name }}</div>
    <div class="col-4">{{ $employee->email }}</div>
</div>
<div class="row mt-1">
    <div class="col-md-12">
        <input type="hidden" name="employee" value="{{ $employee->id }}">
        <div class="form-group">
            <label for="roles"><b>Roles</b></label>
            <select name="roles[]" id="" class="form-select" multiple>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}" >{{ Helper::roleName($role->name) }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
</div>
<div class="row mt-1">
    <div class="col-4">
        @foreach ($assingedRoles as $asrole)
       <span class="badge rounded-pill badge-primary">{{ Helper::roleName($asrole) }} <a href="{{ route(Helper::getGuard().'.role-permission.revoke-role',[$employee->id,$asrole]) }}" class="text-danger">X</a></span>
        @endforeach
    </div>
</div>