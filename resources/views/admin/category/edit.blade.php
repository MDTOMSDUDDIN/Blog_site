@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-white">Edit Category</h2>
            </div>
            <div class="card-body">
                @if (session('Category_add'))
                    <div class="alert alert-success">{{  session('Category_add')  }}</div>
                @endif
                <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label  class="form-label">Category Name </label>
                    <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
                </div>
                <div class="mb-3">
                    <label  class="form-label">Category Image </label>
                    <input type="file" name="category_image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    <div class="my-2">
                        <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" id="blah" width="100" alt="">
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Update_category</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection