@extends('Admin::layouts.simple')

@section('content')
<div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: url('assets/media/photos/photo12@2x.jpg');">
                    <div class="row no-gutters justify-content-center bg-black-75">
                        <!-- Main Section -->
                        <div class="hero-static col-md-6 d-flex align-items-center bg-white">
                            <div class="p-3 w-100">
                                <!-- Header -->
                                <div class="mb-3 text-center">
                                    <a class="link-fx text-primary font-w700 font-size-h1" href="index.html">
                                        <span class="text-dark">Tour</span><span class="text-primary">ism</span>
                                    </a>
                                    <p class="text-uppercase font-w700 font-size-sm text-muted">Forgot Password</p>
                                </div>
                                <!-- END Header -->

                                <!-- Sign Up Form -->
                                <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-sm-8 col-xl-6">
                                        <form class="js-validation-signup" action="{{ route('admin.forgot_password') }}" method="POST">
                                        {{csrf_field()}}
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (!empty(\Session('error')))
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        <li>{{ \Session('error') }}</li>
                                                    </ul>
                                                </div>
                                            @endif
                                            @if (!empty(\Session('success')))
                                                <div class="alert alert-success">
                                                    <ul>
                                                        <li>{{ \Session('success') }}</li>
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input type="email" class="form-control form-control-lg form-control-alt" id="signup-email" name="email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary">
                                                    <i class="fa fa-fw fa-plus mr-1"></i> Send Email
                                                </button>
                                                <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                                    <a class="btn btn-sm btn-light d-block d-lg-inline-block mb-1" href="{{route('admin.signin')}}">
                                                        <i class="fa fa-sign-in-alt text-muted mr-1"></i> Sign In
                                                    </a>
                                                </p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END Sign Up Form -->
                            </div>
                        </div>
                        <!-- END Main Section -->
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

@endsection
