@extends('frontend.author.author_main')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Edit Profile</h3>
            </div>
            <div class="card-body">
                @if(session('profile'))
                    <div class="alert alert-success">{{ session('profile') }}</div>
                @endif
                <form action="{{ route('author.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::guard('author')->user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::guard('author')->user()->email }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Photo</label>
                        <input type="file" class="form-control" name="photo" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="my-2">
                        <div class="my-2">
                            <img src="{{ asset('uploads/author/' . Auth::guard('author')->user()->photo) }}" id="blah" width="200" alt="Profile_Photo">
                        </div>                        
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Change Password</h3>
            </div>
            <div class="card-body">
                @if(session('pass'))
                    <div class="alert alert-success">{{ session('pass') }}</div>
                @endif
                <form action="{{ route('author.pass.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" class="form-control" name="current_password" required>
                        @if(session('err'))
                            <strong class="text-danger">{{ session('err') }}</strong>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">
                            Change Password
                        </button>
                    </div>
                </form> <!-- Missing closing tag added here -->
            </div>
        </div>
    </div>    
</div>




@endsection