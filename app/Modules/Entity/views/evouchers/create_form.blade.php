@extends('Entity::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">
      
    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">E-Vouchers</span> - Create E-Voucher</h4>
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
                      <h5 class="card-title">Create E-Voucher Form</h5>
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
                    <form action="{{route('entity.storeevouchers')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    {{ csrf_field() }}

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">E-Voucher Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="E-Voucher Name" name="name" required>
                            <div class="invalid-feedback">
                            E-Voucher name is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Description</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Description" name="description" required>
                          <div class="invalid-feedback">
                            E-Voucher description is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Discount Type</label>
                        <div class="col-lg-9">
                        <select data-placeholder="Select" id="Discount_Type" name="discount_type" class="form-control select" data-fouc>
                            <option>Select</option>
                            <option value="FIXED">Fixed Amount</option>
                            <option value="PERCENTAGE">Percentage</option>
                        </select>
                        </div>
                      </div>

                      <div class="form-group row" id='enter_percentage' style="display:none;">
                        <label class="col-lg-3 col-form-label">Percentage</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Discount Percentage"  name="discount_percentage">
                        </div>
                      </div>

                      <div class="form-group row" id='enter_amount' style="display:none;">
                        <label class="col-lg-3 col-form-label">Amount</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Discount Amount"  name="discount_amount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Image</label>
                        <div class="col-lg-9">
                          <input type="file" class="form-control" name="image">
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Status:</label>
                        <select data-placeholder="Select" name="status"  class="form-control select" data-fouc style="opacity:1;">
                            <option>Select</option>
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


             $('#Discount_Type').change(function(){
        
             var val=$(this).val();
               if(val=='FIXED')
               {
                $('#enter_amount').css("display","block");
              $('#enter_percentage').css("display","none");
               }
                else
                {
              $('#enter_percentage').css("display","block");
              $('#enter_amount').css("display","none");
                }
             });

</script>

@endsection
