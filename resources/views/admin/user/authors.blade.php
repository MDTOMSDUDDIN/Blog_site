@extends('layouts.admin')
@section('content')
   <div class="row">
    @can('authors')
        
    
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Authors List</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('del'))
                    <div class="alert alert-success">{{ session('del') }}</div>
                @endif
                <table class="table table-bordered">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($authors as $index=>$author )
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $author -> name }}</td>
                        <td>{{ $author -> email }}</td>
                        <td>
                            @if($author->photo ==null)
                            <img src="https://via.placeholder.com/30x30" alt="profile">
                            @else
                            aaa

                            @endif
                        </td>
                        <td>
                            <strong>{{ $author->status ==1?'Active':'Deactive' }}</strong>
                        </td>
                        <td>
                            <a href="{{ route('authors.status',$author->id) }}" class="btn btn-{{ $author->status ==1?'success':'primary' }}">Change Status</a>
                            <a href="{{ route('author.delete',$author->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
           </table>
         </div>
        </div>
    </div>
    @else
<h3>You Don't Have Access To This Page!</h3>
    @endcan
   </div>

@endsection