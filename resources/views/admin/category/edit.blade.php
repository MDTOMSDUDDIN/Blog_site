@extends('layouts.admin')
@section('content')
<div class="col-lg-6 m-auto">
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="text-white">Edit Category</h3>
        </div>
        <div class="card-body">
            @if (session('category_added'))
            <div class="alert alert-success">{{ session('category_added') }}</div>
                
            @endif
            <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
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
                    <img src="{{ asset('uploads/category') }}/{{ $category -> category_image }}" alt="" id="blah" width="200">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection