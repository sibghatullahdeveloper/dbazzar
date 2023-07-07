@extends('Admin::layouts.backend')

@section('content')

    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Add New Cuisines </h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none mb-3 mb-md-0">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt"></i><span>Statistics</span></a>
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator"></i> <span>Invoices</span></a>
                            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5"></i> <span>Schedule</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->
            <div class="content">
                <!-- Centered forms -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10 ">
                                        <div class="header-elements-inline">
                                            <h5 class="card-title">Add Cuisines </h5>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-right">
                                            <a href="{{route('admin.cuisines')}}" class="btn btn-primary">List Cuisines <i class="icon-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                    <form  action="{{ route('admin.cuisines_add') }}" method="POST" class="needs-validation" novalidate>
                                        {{csrf_field()}}



                                        @if(session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif


                                         @if(isset($cuisines->id))
                                             <input type="hidden" value="{{$cuisines->uuid}}" name="cuisines_id">
                                             @endif

                                        <div class="form-group">
                                            <label>Cuisines Name:</label>
                                            <input type="text" class="form-control" name="cuisines"   value="@if (isset($cuisines->name)) {{$cuisines->name}}@endif" placeholder="Enter Cuisines " required>
                                            <div class="invalid-feedback">
                                                Cuisines name is required
                                            </div>
                                            @if ($errors->has('cuisines'))
                                                <div>
                                                    <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('cuisines') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Status:</label>
                                            <select data-placeholder="Select your country" name="status"  class="form-control form-control-select2" data-fouc style="opacity:1;">
                                                <option value="1" @if (isset($cuisines->status) && $cuisines->status==1) selected='selected'@endif >Active</option>
                                                <option value="0" @if  (isset($cuisines->status) && $cuisines->status==0) selected='selected'@endif >InActive</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <div>
                                                    <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('status') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">     @if(isset($cuisines->id))Update Cuisines @else Add Cuisines @endif <i class="icon-paperplane ml-2"></i></button>
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
    </div>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

    </script>
@endsection
