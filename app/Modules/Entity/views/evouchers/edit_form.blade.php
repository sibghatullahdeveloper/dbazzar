@extends('Entity::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">
      
    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">E-Voucher</span> - Edit E-Voucher</h4>
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
                      <h5 class="card-title">Edit E-Voucher Form</h5>
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
                    <form action="{{route('entity.updateevouchers', ['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">E-Voucher Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->name}}" name="name">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Description</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->description}}"  name="description">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Discount Type</label>
                        <div class="col-lg-9">
                        <select data-placeholder="" id="Discount_type" name="discount_type" class="form-control select" data-fouc>
                            <option value="FIXED" {{  ($data->discount_type == 'FIXED' ? ' selected' : '') }}>Fixed Amount</option>
                            <option value="PERCENTAGE" {{  ($data->discount_type == 'PERCENTAGE' ? ' selected' : '') }}>Percentage</option>
                        </select>
                        </div>
                      </div>

                      <div class="form-group row" style="display:none;" id="enter_percentage">
                        <label class="col-lg-3 col-form-label">Percentage</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->discount_percentage}}"  name="discount_percentage">
                        </div>
                      </div>

                      <div class="form-group row" style="display:none;" id="enter_amount">
                        <label class="col-lg-3 col-form-label">Amount</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->discount_amount}}"  name="discount_amount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Image</label>
                        <div class="col-lg-9">
                        <img src="{{url('storage/' . $data->image)}}" class="user-profile-image" style="width:200px;height:200px;"/></td>
                          <input type="file" class="form-control" value="" name="image">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Status</label>
                        <div class="col-lg-9">
                        <select data-placeholder="" name="status" class="form-control select" data-fouc>
                            <option value="1" {{  ($data->status == 1 ? ' selected' : '') }} >Active</option>
                            <option value="0" {{  ($data->status == 0 ? ' selected' : '') }} >InActive</option>
                        </select>
                        </div>
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

              

              $(document).ready(function() {
                var val=$('#Discount_type').val();
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

             $('#Discount_type').change(function(){
        
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
