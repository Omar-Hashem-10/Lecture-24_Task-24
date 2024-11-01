@extends('site.app')

@section('title', 'Contact')

@section('content')
<h1 class="text-center my-3">Contact Page</h1>
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="./index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">contact</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
        <form class="form" action="{{route('contact.store')}}" method="POST" id="contact-form">
            @csrf
            <div class="form-items">
                <div class="mb-3">
                    <label class="form-label required-label" for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" required="">
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="phone">Phone</label>
                    <input type="tel" name="phone" class="form-control" id="phone" required="">
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required="">
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="subject">subject</label>
                    <input type="text" name="subject" class="form-control" id="subject" required="">
                </div>
                <div class="mb-3">
                    <label class="form-label required-label" for="message">message</label>
                    <textarea class="form-control" name="message" id="message" required=""></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>

</div>
@endsection

@push('footer-scripts')
    <script>
        $(document).ready(function() {
            $('#contact-form').submit(function(event){
                event.preventDefault();
                let formData = $(this).serializeArray();
                let url = $(this).attr('action');

                $.ajax({
                    'type': 'POST',
                    'url': url,
                    'data': formData,
                    'success': function(responce) {
                        if(responce.success == true) {
                            toastr.success(responce.message);
                        }
                    },
                });
            });
        });
    </script>
@endpush
