@extends('frontend.master')
@section('content')
   <!--Login-->
   <section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Sign up</h4>
                    {{-- @if (session('author_register'))
                        <div class="alert alert-success">{{ (session('author_register')) }}</div>
                    @endif --}}
                    @if (session('verify'))
                        <div class="alert alert-success">{{ (session('verify')) }}</div>
                    @endif

                    
                    <!--form-->     

                    <form  class="sign-form widget-form" action="{{ route('author.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Full Name*" name="name" value="">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email Address*" name="email" value="">
                            @error('email')
                                <strong class="text-danger">{{ $massage }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                            @error('password')
                                <strong class="text-danger">{{ $massage }}</strong>
                            @enderror
                        </div>
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Agree to our <a href="#" class="btn-link">terms & conditions</a> </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Already have an account? <a href="{{ route('author.login.page') }}" class="btn-link">Login</a> </p>
                    </form>
                       <!--/-->
                </div> 
            </div>
         </div>
    </div>
</section>       

@endsection