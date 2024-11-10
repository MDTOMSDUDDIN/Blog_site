@extends('frontend.master')
@section('content')
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Request for verification link</h4>
                    <p></p>
                    @if (session('verify'))
                        <div class="alert alert-success">{{ session('verify') }}</div>
                    @endif
                    <form  action="{{ route('request.verify.send') }}" class="sign-form widget-form " method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email*" name="email">
                        </div>
              
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Send Request</button>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</section>

@endsection