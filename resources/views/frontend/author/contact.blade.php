@extends('frontend.master')
@section('content')

    <!-- Section Heading -->
    <div class="section-heading">
        <div class="container-fluid">
            <div class="section-heading-2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-heading-2-title">
                            <h1>Contact Us</h1>
                            <p class="links"><a href="{{ route('index') }}">Home <i class="las la-angle-right"></i></a> Contact</p>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <!-- Contact -->
    <section class="contact">
        <div class="container-fluid">
            <div class="contact-area">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-image">
                            <img src="{{ asset('uploads/contact/contact.jpg') }}" alt="Contact Us Image" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-info">
                            <h3>Feel Free To Contact Us</h3>
                            <p>Please Send Your Contact Details.</p>
                        </div>
                        
                        <!-- Display Success Message -->
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- Form -->
                        <form action="{{ route('contact.submit') }}" method="POST" class="form contact_form" id="main_contact_form">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name*" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email*" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject*" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Message*" required></textarea>
                            </div>
                            <button type="submit" class="btn-custom">Send Message</button>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </section>

@endsection
