@extends('layouts.admin')
@section('content')
<div class="row">
    @can('category_access')
        
    
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Category List</h3>
            </div>
            <div class="card-body">
                @if (session('cat_update'))
            <div class="alert alert-success">{{ session('cat_update') }}</div>
            @endif
            @if (session('category_del'))
            <div class="alert alert-success">{{ session('category_del') }}</div>
            @endif
                <form action="{{ route('category.check.delete') }}" method="POST">
                    @csrf
                    <table class="table table-striped">
                    <tr>
                        <th width="50"><div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="chkSelectAll">
                                Check All
                            <i class="input-frame"></i></label>
                        </div></th>
                        <th>SL</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($categories as $index=>$category )
                        <tr>
                            <td><div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" name="category_id[]" value="{{ $category -> id }}" class="form-check-input chkDel">
                                <i class="input-frame"></i></label>
                            </div></td>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="">
                        </td>
                        <td>
                            <a href="{{ route('category.edit',$category->id) }}" class="btn btn-info">Edit</a>
                            <a href="{{ route('category.delete',$category->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">
                                <h3 >No Data Available</h3>
                            </td>
                        </tr>
                
                    @endforelse
                </table>
                <div class="my-2">
                    <button type="submit" class="btn btn-danger del_check d-none">Delete Checked</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @else
<h3>You Don't Have Access To This Page!</h3>
    @endcan
    @can('category_add')
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Add New Category</h3>
            </div>
            <div class="card-body">
                @if (session('category_added'))
                <div class="alert alert-success">{{ session('category_added') }}</div>
                    
                @endif
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="category_name" class="form-control">
                        @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                            
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Category Image</label>
                        <input type="file" class="form-control" name="category_image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        @error('category_image')
                            <strong class="text-danger">{{ $message }}</strong>
                            
                        @enderror
                    </div>
                    <div class="my-2">
                        <img src="" alt="" id="blah" width="200">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
<h3>You Don't Have Access To This Page!</h3>
    @endcan
</div>
@endsection


@section('script')
    <script>
        $("#chkSelectAll").on('click', function(){
        this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false); 
        $('.del_check').toggleClass('d-none')
        })

        $(".chkDel").on('click', function(){
            $('.del_check').removeClass('d-none')
        })
    </script>

@endsection