@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-white">Category List </h2>
            </div>
            <div class="card-body">
                @if (session('updated'))
                    <div class="alert alert-success">{{ session('updated') }}</div>
                @endif
                @if (session('category_del'))
                <div class="alert alert-success">{{ session('category_del') }}</div>
               @endif
               <form action="{{ route('category.check.delete') }}" method="POST">
                @csrf
                    <table class="table table-striped">
                        <tr>
                            <th width="40">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"  id="chkSelectAll">
                                    Check All
                                    <i class="input-frame"></i></label>
                                </div>
                            </th>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Image </th>
                            <th>Action</th>
                        </tr>
                    @forelse ($categories as $index=>$category )
                        
                
                        <tr>
                            <td>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="category_id[]" value="{{  $category->id }}" class="form-check-input chkDel">
                                    <i class="input-frame"></i></label>
                            </td>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('category.delete',$category->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                          <tr>
                            <td class="text-center" colspan="5"><h2 >No Data Available</h2></td>
                          </tr>
                        @endforelse
                    </table>
                    <div class="my-2">
                        <button type="submit" class="btn btn-danger  del_check d-none">Delete Checked </button>
                    </div>
            </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header bg-primary">
            <h2 class="text-white">Add New Category</h2>
        </div>
        <div class="card-body">
            @if (session('Category_add'))
                <div class="alert alert-success">{{  session('Category_add')  }}</div>
            @endif
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label  class="form-label">Category Name </label>
                <input type="text" name="category_name" class="form-control">
                @error('category_name')
                    <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="mb-3">
                <label  class="form-label">Category Image </label>
                <input type="file" name="category_image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                <div class="my-2">
                    <img src="" id="blah" width="100" alt="">
                </div>
                @error('category_image')
                 <strong class="text-danger">{{ $message }}</strong>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add_category</button>
            </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#chkSelectAll").on('click', function(){
     this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);  
     $('.del_check').toggleClass('d-none');
    })

    $(".chkDel").on('click', function(){
     $('.del_check').removeClass('d-none');
    })
</script>
@endsection