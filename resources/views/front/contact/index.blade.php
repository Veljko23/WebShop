@extends('front._layout.layout')
@section('seo_title', 'Contact Us')

@section('content')

<!-- Breadcumb Area -->
<div class="breadcumb_area">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <h5>Contact</h5>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.index.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Contact</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcumb Area -->

<!-- Message Now Area -->
<div class="message_now_area section_padding_100" id="contact">
    <div class="container">
        
        @if(!empty($systemMessage))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{$systemMessage}}
            
        </div>
        
        @endif
        
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="popular_section_heading mb-50 text-center">
                    <h5 class="mb-3">Stay Conneted with us</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="single-contact-info mb-30">
                    <i class="icofont-phone"></i>
                    <p>+00 88 1125263 <br> +00 88 1125264</p>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="single-contact-info mb-30">
                    <i class="icofont-ui-email"></i>
                    <p>support@example.com <br> help@example.com</p>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="single-contact-info mb-30">
                    <i class="icofont-fax"></i>
                    <p>+00 88 96874 <br> +00 88 96875</p>
                </div>
            </div>

            <div class="col-12">
                <div class="contact_from mb-50">
                    @include('front.contact.partials.contact_form')
                </div>
            </div>

            <div class="col-12">
                <div class="google-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.4733933767!2d-0.24167960602552738!3d51.52855824355498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2sbd!4v1565062036569!5m2!1sen!2sbd" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Message Now Area -->

@endsection