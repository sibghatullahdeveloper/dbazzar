@extends('layouts.backend')

@section('content')


<!-- Tab panes -->



<div class="account-section pt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="row">
                        <div class="col-lg-6 col-xl-6 px-3 my-5">
                            <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                                {{csrf_field()}}
                                <div class="box-shadow1 p-5 mb-5">
                                    <div class="h3 text-uppercase text-center box-title">Login</div>
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

                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" id="" name="email" placeholder="Someone@email.com">
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                        <div class="form-control-feedback">
                                            <i class="icon-lock2 text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="px-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-login btn-block mt-5 text-uppercase font-12">Login</button>

                                        </div>
                                        <div class="form-group">
                                            <small class="d-block text-center forget-pass mb-2"><a href="{{route('forgot_password')}}">Forget Password</a></small>
                                            <b>Or</b>
                                        </div>
                                        <div class="form-group">
                                            <a  href="{{url('/login/facebook')}}" class="btn btn-fb btn-block p-2 text-uppercase font-12">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12.487" height="22" viewBox="0 0 12.487 22" class="float-left ml-2">
                                                    <path id="facebook_2_" data-name="facebook (2)" d="M9.388,5.445c.03-.034.171-.145.722-.145h1.809a1.068,1.068,0,0,0,1.067-1.067V1.071A1.069,1.069,0,0,0,11.921,0L9.234,0A5.529,5.529,0,0,0,5.157,1.582a5.806,5.806,0,0,0-1.535,4.16V7.447H1.567A1.068,1.068,0,0,0,.5,8.514v3.4a1.068,1.068,0,0,0,1.067,1.067H3.622v7.947A1.068,1.068,0,0,0,4.689,22H8.213A1.068,1.068,0,0,0,9.28,20.933V12.986h2.512a1.068,1.068,0,0,0,1.067-1.067V8.514a1.071,1.071,0,0,0-.549-.933,1.084,1.084,0,0,0-.528-.134H9.28V6.1c0-.439.059-.6.109-.654Zm0,0" transform="translate(-0.5 0)" fill="#fff"/>
                                                </svg>
                                               Login with facebook
                                            </a>
                                        </div>
                                        <div class="form-group">
                                            <a  href="{{url('/login/google')}}" class="btn btn-g btn-block p-2 text-uppercase font-12">
                                                <svg id="search" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" class="float-left ml-2">
                                                    <path id="Path_250" data-name="Path 250" d="M4.876,145.622,4.11,148.48l-2.8.059a11.019,11.019,0,0,1-.081-10.272h0l2.492.457L4.814,141.2a6.565,6.565,0,0,0,.062,4.42Z" transform="translate(0 -132.327)" fill="#fff"/>
                                                    <path id="Path_251" data-name="Path 251" d="M272.194,208.176a11,11,0,0,1-3.921,10.633h0l-3.139-.16-.444-2.773a6.556,6.556,0,0,0,2.821-3.348h-5.882v-4.352h10.566Z" transform="translate(-250.386 -199.231)" fill="#fff"/>
                                                    <path id="Path_252" data-name="Path 252" d="M47.084,315.692h0a11,11,0,0,1-16.576-3.365l3.565-2.918a6.542,6.542,0,0,0,9.427,3.35Z" transform="translate(-29.198 -296.114)" fill="#fff"/>
                                                    <path id="Path_253" data-name="Path 253" d="M45.415,2.532,41.852,5.45a6.541,6.541,0,0,0-9.644,3.425L28.625,5.941h0A11,11,0,0,1,45.415,2.532Z" transform="translate(-27.394)" fill="#fff"/>
                                                </svg>
                                                Login with google
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-xl-6 px-3 my-5">
                            <div class="box-shadow1 p-5">
                                <div class="h3 text-uppercase box-title text-center">Signup</div>
                                <form class="js-validation-signup" action="{{ route('register') }}" method="POST">
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

                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <input type="text" class="form-control" value="{{old('first_name')}}" name="first_name" placeholder="First Name">
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <input type="text" class="form-control" value="{{old('last_name')}}" name="last_name" placeholder="Last Name">
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email">
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" value="{{old('username')}}" name="username" placeholder="Username">
                                        <div class="form-control-feedback">
                                            <i class="icon-user text-muted"></i>
                                        </div>
                                    </div>

                                        <div class="form-group">
                                        <label for="">Mobile Number</label>
                                        <div class="d-flex">
                                            <select>
                                                <option>
                                                    <span>🇵🇰</span>
                                                </option>
                                            </select>
                                            <input type="text" class="form-control" value="{{old('contact_number')}}" name="contact_number" placeholder="mobile number">
                                            <div class="form-control-feedback">
                                                <i class="icon-user text-muted"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                        <div class="form-control-feedback">
                                            <i class="icon-lock2 text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password">
                                        <div class="form-control-feedback">
                                            <i class="icon-lock2 text-muted"></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <small>By creating an account you agree to receive sms from vendor</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="" id="terms" >
                                        <label for="terms" style="font-family: Poppins-Regular;"class="font-14">I Agree To The Terms & Conditions </label>
                                    </div>
                                    <div class="px-2">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-login btn-block text-uppercase font-12">signup</button>
                                        </div>
                                        <div class="form-group">
                                            <small class="forget-pass"></small>
                                            <b>Or</b>
                                        </div>
                               <!--          <div class="form-group">
                                            <a  href="{{url('/login/facebook')}}" class="btn btn-fb btn-block p-2 text-uppercase font-12">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12.487" height="22" viewBox="0 0 12.487 22" class="float-left ml-2">
                                                    <path id="facebook_2_" data-name="facebook (2)" d="M9.388,5.445c.03-.034.171-.145.722-.145h1.809a1.068,1.068,0,0,0,1.067-1.067V1.071A1.069,1.069,0,0,0,11.921,0L9.234,0A5.529,5.529,0,0,0,5.157,1.582a5.806,5.806,0,0,0-1.535,4.16V7.447H1.567A1.068,1.068,0,0,0,.5,8.514v3.4a1.068,1.068,0,0,0,1.067,1.067H3.622v7.947A1.068,1.068,0,0,0,4.689,22H8.213A1.068,1.068,0,0,0,9.28,20.933V12.986h2.512a1.068,1.068,0,0,0,1.067-1.067V8.514a1.071,1.071,0,0,0-.549-.933,1.084,1.084,0,0,0-.528-.134H9.28V6.1c0-.439.059-.6.109-.654Zm0,0" transform="translate(-0.5 0)" fill="#fff"/>
                                                </svg>
                                                sign up with facebook
                                            </a>

                                        </div> -->
                                       <!--  <div class="form-group">
                                            <a  href="{{url('/login/google')}}" class="btn btn-g btn-block p-2 text-uppercase font-12">
                                                <svg id="search" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" class="float-left ml-2">
                                                    <path id="Path_250" data-name="Path 250" d="M4.876,145.622,4.11,148.48l-2.8.059a11.019,11.019,0,0,1-.081-10.272h0l2.492.457L4.814,141.2a6.565,6.565,0,0,0,.062,4.42Z" transform="translate(0 -132.327)" fill="#fff"/>
                                                    <path id="Path_251" data-name="Path 251" d="M272.194,208.176a11,11,0,0,1-3.921,10.633h0l-3.139-.16-.444-2.773a6.556,6.556,0,0,0,2.821-3.348h-5.882v-4.352h10.566Z" transform="translate(-250.386 -199.231)" fill="#fff"/>
                                                    <path id="Path_252" data-name="Path 252" d="M47.084,315.692h0a11,11,0,0,1-16.576-3.365l3.565-2.918a6.542,6.542,0,0,0,9.427,3.35Z" transform="translate(-29.198 -296.114)" fill="#fff"/>
                                                    <path id="Path_253" data-name="Path 253" d="M45.415,2.532,41.852,5.45a6.541,6.541,0,0,0-9.644,3.425L28.625,5.941h0A11,11,0,0,1,45.415,2.532Z" transform="translate(-27.394)" fill="#fff"/>
                                                </svg>
                                                sign up with google
                                            </a>
                                        </div> -->
                                        <div class="form-group">
                                            <a  href="{{route('guestCheckout')}}"  class="btn btn-guest btn-block p-2 text-uppercase font-12">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.281" height="22.798" viewBox="0 0 22.281 22.798" class="float-left ml-2">
                                                    <g id="hat" transform="translate(-5.8 0)">
                                                        <g id="Group_147" data-name="Group 147" transform="translate(5.8 0)">
                                                            <g id="Group_146" data-name="Group 146" transform="translate(0 0)">
                                                                <path id="Path_258" data-name="Path 258" d="M25,9.429,23.822,1.883A2.059,2.059,0,0,0,22.846.41C21.627-.327,19.731.127,18.71.463h0a5.376,5.376,0,0,1-3.539,0C13.917.05,12.183-.3,11.042.392a2.086,2.086,0,0,0-.984,1.5L8.878,9.429a2.972,2.972,0,1,0-.107,5.942H25.11A2.972,2.972,0,1,0,25,9.429Zm-14.622,0,.31-1.981h12.5l.31,1.981Z" transform="translate(-5.8 0)" fill="#fff"/>
                                                            </g>
                                                        </g>
                                                        <g id="Group_149" data-name="Group 149" transform="translate(7.285 16.856)">
                                                            <g id="Group_148" data-name="Group 148" transform="translate(0)">
                                                                <path id="Path_259" data-name="Path 259" d="M57.728,380.045h-.743V379.3a.743.743,0,0,0-.743-.743H50.3a.743.743,0,0,0-.743.743v.743H48.073V379.3a.743.743,0,0,0-.743-.743H41.388a.743.743,0,0,0-.743.743v.743H39.9a.743.743,0,1,0,0,1.485h.818a3.714,3.714,0,0,0,7.278,0h1.635a3.714,3.714,0,0,0,7.278,0h.818a.743.743,0,1,0,0-1.485Z" transform="translate(-39.16 -378.56)" fill="#fff"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                                continue as guest
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        </div>
                  </div>
            </div>
        </div>
    </div>
</div>





 @yield('js_after')
 @endsection
