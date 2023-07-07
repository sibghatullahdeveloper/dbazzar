@extends('layouts.backend')

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
                                    
                                    <p class="text-uppercase font-w700 font-size-sm text-muted">Reset Password</p>
                                </div>
                                <!-- END Header -->

                                <!-- Sign Up Form -->
                                <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js) -->
                                <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-sm-8 col-xl-6">
                                        <form class="js-validation-signup" action="{{ route('reset_password_store') }}" method="POST">
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
                                            {{ Form::hidden('token',$token) }}
                                            <div class="py-3">
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password" name="password" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password-confirm" name="password_confirm" placeholder="Password Confirm">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn-hero-lg btn-hero-primary">
                                                    <i class="fa fa-fw fa-plus mr-1"></i> Reset
                                                </button>
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
