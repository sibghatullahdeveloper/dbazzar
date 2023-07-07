@extends('Admin::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">
      
    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Affiliates</span> - Create Affiliate</h4>
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
                      <h5 class="card-title">Create Affiliates Form</h5>
                      <div class="header-elements">
                        <div class="list-icons">
                                  
                                </div>
                              </div>
                            </div>
                  </div>
                </div>
              </div>
              @if(session()->has('success'))
              <div class="alert alert-success">
              {{ session()->get('success') }}
              </div>
              @endif
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <form action="{{route('admin.storeaffiliates')}}" method="POST" class="needs-validation" novalidate>
                    {{ csrf_field() }}

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Affiliate Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Affiliate's Name" name="name" required>
                          <div class="invalid-feedback">
                            Affiliate Name is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Address</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Address" name="address" required>
                          <div class="invalid-feedback">
                            Affiliate's Address is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Contact</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Contact" name="contact" required>
                          <div class="invalid-feedback">
                            Affiliate's Contact is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Email" name="email" required>
                          <div class="invalid-feedback">
                            Affiliate's Email is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Login's Password</label>
                        <div class="col-lg-9">
                          <input type="password" class="form-control" placeholder="password" name="password" required>
                          <div class="invalid-feedback">
                            Login's Password is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Affiliate Post Type:</label>
                        <select data-placeholder="Select" id="Affiliate_Post_Type" name="affiliate_post_type"  class="form-control select" data-fouc style="opacity:1;">
                            <option value="">Select</option>
                            <option value="AM" >Area Manager</option>
                            <option value="SAM" >Sub Area Manager</option>
                            <option value="AF" >Affiliates</option>
                        </select>
                      </div>

                      <div class="form-group" style="display:none;" id="select_area1">
                        <label>Select Area</label>
                        <select data-placeholder="Select" class="form-control select" id="select_area" name="area_id"  data-fouc>
                          <option value="">Select</option>
                          <optgroup label="Areas">
                          @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->name}}</option>
                          @endforeach
                          </optgroup>
                        </select>
                      </div>

                      <div class="form-group" style="display:none;" id="select_sub_area1" >
                        <label>Select Sub Area</label>
                          <select data-placeholder="Select" id="select_sub_area" name="sub_area_id"  class="form-control form-control-lg select-search" data-container-css-class="select-lg" data-fouc>
                              <option value=""></option>
                          </select>
                      </div>

                      <div class="form-group">
                        <label>Status:</label>
                        <select data-placeholder="Select" name="status"  class="form-control select" data-fouc style="opacity:1;">
                            <option value="1" >Active</option>
                            <option value="0" >InActive</option>
                        </select>
                      </div>

                      <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
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


             $('#Affiliate_Post_Type').change(function(){
        
             var val=$(this).val();
               if(val=='AM')
               {
                $('#select_area1').css("display","block");
              $('#select_sub_area1').css("display","none");
               }
                else
                {
              $('#select_area1').css("display","block");
              $('#select_sub_area1').css("display","block");
                }
             });


          $('#select_area').change(function(){
            var id = $(this).val();
            $('#select_sub_area').find('option').not(':first').remove();
            $.ajax({
                url: '{{route('admin.sub_area_list')}}',
                type: 'post',
                data:{"_token": "{{ csrf_token() }}",id:id},
                dataType: 'json',
                success: function(response){
                    console.log(response,"result");
                    var len = 0;
                    if(response != null){
                        len = response.length;
                    }
                    console.log(len, response);
                    if(len > 0){
                        // Read data and create <option >
                        for(var i=0; i<len; i++){

                            var id = response[i].id;

                            var name = response[i].name;

                            var option = "<option value='"+id+"'>"+name+"</option>";
                            $("#select_sub_area").append(option);
                        }
                    }

                }
            });
        });

</script>

@endsection
