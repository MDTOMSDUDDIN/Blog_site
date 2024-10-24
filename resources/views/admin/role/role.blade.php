@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h2>Role List </h2>
            </div>
           <div class="table-responsive">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Role</th>
                        <th>Permission</th>
                        <th>Action</th>
                    </tr>
                   @foreach ($roles as $index=>$role)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->getPermissionNames() as $permission)
                            <span class="badge badge-primary">{{ $permission }}</span>
                                
                            @endforeach
                        </td>
                        <td>
                            <a href="" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                  
                       
                   @endforeach
                </table>
            </div>
           </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add New Permission </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" name="permission_name">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Add_permission</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
              <h3>Add New Role </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Role Name </label>
                        <input type="text" name="role_name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <h3><label for="" class="form-label">Select Permission </label></h3>
                        <br>
                        @foreach ($permissions as $permission)
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input value="{{ $permission->name }}" type="checkbox" name="permission[]" class="form-check-input">
                                {{ $permission->name }}
                            <i class="input-frame"></i></label>
                        </div>
                        @endforeach
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary"> Add_role</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection