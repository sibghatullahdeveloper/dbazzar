@extends('Admin::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">
      
    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Add Ons</span> - Create Add On</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
                  <div class="col-md-10 offset-md-1">
                    <div class="header-elements-inline">
                      <h5 class="card-title">Create Add On Form</h5>
                      <div class="header-elements">
                        <div class="list-icons">
                                  
                                </div>
                              </div>
                            </div>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <form action="{{route('admin.orderstatus_add')}}" method="POST" class="needs-validation" novalidate>
                    {{ csrf_field() }}

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Add On Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Order Status Name" name="name" required>
                            <div class="invalid-feedback">
                            Order Status name is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Status:</label>
                        <select data-placeholder="Select your country" name="status"  class="form-control select" data-fouc style="opacity:1;">
                            <option value="1" >Active</option>
                            <option value="0" >InActive</option>
                        </select>
                      </div>

                      <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form<i class="icon-paperplane ml-2"></i></button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
                </div>
        <!-- /form centered -->

    </div>
<div>

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
