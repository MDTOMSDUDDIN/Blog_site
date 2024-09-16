@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary">
               <h2 class="text-white">Users List</h2>
            </div>
            <div class="card-body">
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
                            <td><img src="{{ asset('uploads/user') }}/{{ $user->photo }}" alt=""></td>
                            <td><a class="btn btn-danger" href="">Delete</a></td>
                        </tr>
    
                   @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection