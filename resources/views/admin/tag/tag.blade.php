@extends('layouts.admin')

@section('content')
@can('tag_access')
    

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Tags List</h3>
            </div>
            <div class="card-body">
                @if (session('del'))
                <div class="alert alert-success">{{ session('del') }}</div>
                @endif
                    <table class="table table-striped">
                    <tr>
                        <th>SL</th>
                        <th>Tag Name</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($tags as $index=>$tag )
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $tag->tag_name }}</td>
                        <td> <a href="{{ route('tags.delete',$tag->id ) }}" class="btn btn-danger">Delete</a></td> 
                    </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">
                                <h3 >No Data Available</h3>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3>Add New Tags</h3>
            </div>
            <div class="card-body">
                @if (session('tags'))
                <div class="alert alert-success">{{ session('tags') }}</div>
                @endif
                <form action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Tag Name</label>
                        <input type="text" name="tag_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add Tag</button>
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