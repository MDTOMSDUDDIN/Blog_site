@extends('layouts.admin');
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="h2 text-white">Edit Profile</div>
                </div>
                <div class="card-body">
                        @if (session('profile'))
                            <div class="alert alert-success">{{ session('profile') }}</div>
                        @endif
                    <form action="{{ route('update.profile') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"  value="{{ Auth::user()->email }}">
                        </div>
                        <div class="mb-3">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h2 class="text-white">Changed Password </h2>
                </div>
                <div class="card-body">
                    @if (session('pass'))
                        <div class="alert alert-success">{{ session('pass') }}</div>
                    @endif
                    <form action="{{ route('update.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="current_password">
                            @error('current_password')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                            @if (session('err'))
                                <strong class="text-danger">{{ session('err') }}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="password">
                            @error('password')
                             <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                            @error('password_confirmation')
                              <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h2 class="text-white">Upload Image</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        @error('photo')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                        <label for="" class="form-label">Upload Image :</label>
                        <input type="file" name="photo" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img src="{{ asset('uploads/user') }}/{{ Auth::user()->photo }}" alt="photo" id="blah" width="100">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Upload_photo</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection