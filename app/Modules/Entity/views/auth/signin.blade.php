@extends('Admin::layouts.simple')

@section('content')

    <div id="page-content">

        <!-- Main Container -->
        <main id="content-wrapper">




        <div class="content d-flex justify-content-center align-items-center pt-0" style="margin-top:100px">

				<!-- Login form -->
				<form class="js-validation-signin" action="{{ route('entity.signin') }}" method="POST">

                 {{csrf_field()}}

					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Enter your credentials below</span>
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
								<input type="email" class="form-control" name="email" placeholder="Email">
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

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="text-center">
								<a href="login_password_recover.html">Forgot password?</a>
							</div>
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>

            <!-- Page Content -->

            <!-- END Page Content -->

        </main>
        <!-- END Main Container -->
    </div>

@endsection
