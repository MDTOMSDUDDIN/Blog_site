@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary">
               <h2 class="text-white">Users List</h2>
            </div>
            <div class="card-body">
                @if (session('del'))
                    <div class="alert alert-success">{{ session('del') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    @foreach ($users as $index=>$user ) 
                      <tr>
                            <td>{{  $index+1  }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->photo ==null)
                                <img src="https://via.placeholder.com/30x30" alt="profile">
                                @else
                                <img src="{{ asset('uploads/user') }}/{{ $user->photo }}" alt="">
                                @endif
                               </td>
                            <td><a class="btn btn-danger" href="{{ route('user.delete',$user->id) }}">Delete</a></td>
                        </tr>
    
                   @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-white">Add New User</h2>
            </div>
            <div class="card-body">
                 @if (session('Add_user'))
                     <div class="alert alert-success">{{ session('Add_user') }}</div>
                 @endif
                <form action="{{ route('add.user') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label"> Name </label>
                        <input type="text" name="name"  class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"> Email </label>
                        <input type="email" name="email"  class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"> Password </label>
                        <input type="password" name="password"  class="form-control">
                    </div>
                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary" >Add_user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection