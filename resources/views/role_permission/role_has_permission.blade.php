<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route(Helper::getGuard() . '.role-permission.assign-permission') }}" method="post">
                    @csrf
                    <input type="hidden" name='roleid' value="{{ $selectrole->id }}">
                    <table  class="table table-bordered">
                        <thead class="bg-primary">
                            <tr>
                                <th>Permissions Name</th>
                                <th>Menu</th>
                                <th>Create</th>
                                <th>Read</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!isset($permissionnames))
                                <tr>
                                    <td colspan="7">No permission assigned</td>
                                </tr>
                            @else
                                @foreach ($permissionnames as $pname)
                                    <tr>
                                        <th>
                                            {{ $pname->permission_name }}
                                        </th>
                                        
                                        @foreach ($pname->permissions as $permission)
                                        
                                            <td>
                                                <label>
                                                    <input type="checkbox" class="form-checked" value="{{$permission->name}}" name='rolepermissions[]'
                                                    {{ $selectrole->hasPermissionTo($permission->name,'employee') ? 'checked' : '' }}/>
                                                    <span></span>
                                                  </label>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                    <button class="btn btn-primary mt-2 pull-right" type="submit"> Update Permission</button>
                </form>

            </div>

        </div>
    </div>

</div>
