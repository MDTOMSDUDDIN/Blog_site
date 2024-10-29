@extends('layouts.admin')
@section('content')
@can('tag_access')
  <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header bg-primary">
            <h2 class="text-white">Tag Lists</h2>
          </div>
          <div class="card-body">
            @if (session('Tag_delete'))
              <div class="alert alert-danger">{{ session('Tag_delete') }}</div>
            @endif
            <table class="table table-bordered">
              <tr>
                <th>SL</th>
                <th>Tag Name</th>
                <th>Action</th>
              </tr>
              @foreach ($tags as $index=>$tag)
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $tag->tag_name }}</td>
                <td>
                  <a href="{{ route('tag.delete', $tag->id) }}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
          <div class="card">
              <div class="card-header bg-primary">
                  <h2 class="text-white">Add New Tag</h2>
              </div>
              <div class="card-body">
                @if (session('add'))
                  <div class="alert alert-success">{{ session('add') }}</div>
                @endif
                  <form action="{{ route('tag.store') }}" method="POST">
                      @csrf
                    <div class="mb-3">
                      <label for="" class="form-label"> Tag Name </label>
                      <input type="text" name='tag_name' class="form-control">
                    </div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary">Add_Tag</button>
                    </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endcan
@endsection