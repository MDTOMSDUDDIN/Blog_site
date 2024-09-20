@extends('frontend.author.author_main')
@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-white">Edit Profile</h2>
            </div>
            <div class="card-boby">
                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif
                <form action="{{ route('author.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::guard('author')->user()->name }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::guard('author')->user()->email }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Photo</label>
                    <input type="file" name="photo" class="form-control"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    <div class="my-2">
                        <img src="{{ asset('uploads/author') }}/{{ Auth::guard('author')->user()->photo }}" id="blah" width="100" alt="">
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit"  class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h2 class="text-white">Password Update </h2>
            </div>
            <div class="card-body">
                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif
                <form action="{{ route('author.pass.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-control"> Current Password</label>
                        <input type="password" name="current_password" class="form-control">
                        @if (session('wrong'))
                            <strong class="text-danger">{{ session('wrong') }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-control"> New Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-control"> Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" >Change_password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection