@extends('layouts.backend')

@section('content')

    <div id="page-content">

        <!-- Main Container -->
        <main id="content-wrapper">

        
        <div class="content d-flex justify-content-center align-items-center " >

				<!-- Login form -->
				<form class="js-validation-signup" action="{{ route('register') }}" method="POST">

                 {{csrf_field()}}
                           <br>     
					<div class="card">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Register your account</h5>
                                <br><br>
							</div>
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
                                    <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control" value="{{old('first_name')}}" name="first_name" placeholder="First Name">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" placeholder="Last Name">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                             <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control" value="{{old('username')}}" name="username" placeholder="Username">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" name="password" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign up <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="text-center">
								<a href="{{route('signin')}}">Already have Account?</a>
							</div>
						</div>
					</div>
				</form>

				<!-- /login form -->

			</div>

            <!-- Page Content -->
           
            <!-- END Page Content -->
             <br><br>
        </main>
        <!-- END Main Container -->
    </div>

@endsection
