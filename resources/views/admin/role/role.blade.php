@extends('layouts.admin')
@section('content')
@can('role_access')
    

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Role List</h3>
            </div>
            <div class="card-body">
                @if (session('del'))
                    <div class="alert alert-success">{{ session('del') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($roles as $index=>$role )
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->getPermissionNames() as $permission )
                                <span class="badge badge-primary">{{ $permission }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('role.delete',$role->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div> <!-- End table-responsive -->
            </div>
        </div>
        
        <div class="card mt-5">
            <div class="card-header bg-primary">
                <h3 class="text-white">User List</h3>
            </div>
            <div class="card-body">
                @if (session('delete'))
                    <div class="alert alert-success">{{ session('delete') }}</div>
                @endif
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($Users as $index=>$user )
                        <tr>
                            <td>{{ $index +1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $role )
                                    <span class="badge badge-primary">{{ $role }}</span>
                                @empty
                                <span class="badge badge-secondary">No Role Assigned!</span>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{ route('role.remove',$user->id) }}" class="btn btn-danger">Remove Role</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
    <div class="col-lg-4">
        


        {{-- <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Add New Permission</h3>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('permission.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label  class="form-label">Permission Name</label>
                        <input type="text" name="permission_name" class="form-control">
                    @if ($errors->has('permission_name'))
                        <strong class="text-danger">{{ $errors->first('permission_name') }}</strong>
                    @endif
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add Permission</button>
                    </div>
                </form>
            </div>
        </div> --}}
        <div class="card mt-3">
            <div class="card-header bg-primary">
                <h3 class="text-white">Add New Role</h3>
            </div>
            <div class="card-body">
                @if (session('success_role'))
                    <div class="alert alert-success">{{ session('success_role') }}</div>
                @endif
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label  class="form-label">Role Name</label>
                        <input type="text" name="role_name" class="form-control">
                    @if ($errors->has('role_name'))
                        <strong class="text-danger">{{ $errors->first('role_name') }}</strong>
                    @endif
                    </div>
                    
                    <div class="mb-3">
                        <h5><label  class="form-label">Select Permission</label></h5>
                        
                        @foreach ($permissions as $permission )

                            <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input value="{{ $permission->name }}" name="permission[]" type="checkbox" class="form-check-input">
                                {{ $permission->name }}
                            <i class="input-frame"></i></label>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add Role</button>
                    </div>
                </form>
        
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-header bg-primary">
                <h3 class="text-white">Assign Role</h3>
            </div>
            <div class="card-body">
                @if (session('success_assign'))
                <div class="alert alert-success">{{ session('success_assign') }}</div>
                @endif
                <form action="{{ route('role.assign') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <select name="user_id" id="" class="form-control">
                            <option value="">Select User</option>
                            @foreach ($Users as $User )
                               <option value="{{ $User->id }}">{{ $User->name }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="role" id="" class="form-control">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role )
                               <option value="{{ $role->name }}">{{ $role->name }}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Assign Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
<h3>You Don't Have Access To This Page!</h3>
@endcan
@endsection