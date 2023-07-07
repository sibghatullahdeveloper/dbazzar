@extends('Entity::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">
      
    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Add On Categories</span> - Create Add On Category</h4>
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
                      <h5 class="card-title">Create Add On Category Form</h5>
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
                    <form action="{{route('entity.storeaddonscategory')}}" method="POST" class="needs-validation" novalidate>
                    {{ csrf_field() }}

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Add Ons Category Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Add Ons Category Name" name="name" required>
                          <div class="invalid-feedback">
                            Add On Category name is required
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Description</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" placeholder="Description" name="description" >
                        </div>
                      </div>
                       <div class="form-group">
                        <label>Required</label>
                         <input type="number" class="form-control" placeholder="Required" maxlength="2" name="required" id="required" >
                      </div>
                       <div class="form-group">
                        <label>Order By</label>
                         <input type="number" class="form-control" placeholder="Order By" maxlength="2" name="order_by"  >
                      </div>
                      <div class="form-group">
                        <label>Select Add On Selection Type</label>
                        <select data-placeholder="Select Selection Type" class="form-control select" id="selection_type" name="selection_type" data-fouc>
                          <option value="SINGLE">Single</option>
                          <option value="MULTI">Multiple</option>
                        </select>
                      </div>
                         <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Minimum Selection:</label>
                                <input type="number" class="form-control" placeholder="Minimum" maxlength="2" name="min_selection" id="min_selection" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">Maximum Selection:</label>
                                 <input type="number" class="form-control" placeholder="Maximum" maxlength="2" name="max_selection" id="max_selection" readonly >
                              </div>
                           </div>
                      <div class="form-group">
                        <label>Select Add Ons</label>
                        <select data-placeholder="Select Multiple" class="form-control select" name="addons_id[]" data-fouc multiple>
                          <optgroup label="Add Ons">
                          @foreach($addons as $data)
                            <option value="{{$data->id}}">{{$data->name}} - {{$data->price}}</option>
                          @endforeach
                          </optgroup>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Status:</label>
                        <select data-placeholder="Select your country" name="status"  class="form-control select" data-fouc style="opacity:1;">
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

</script>
<script type='text/javascript'>
   $(document).ready(function(){
   
       // Department Change
       $('#selection_type').change(function(){
   
           // Department id
           var value = $(this).val();
            alert(value);
        if(value == 'MULTI')

          {
            $('#min_selection').prop("readonly", false);
            $('#max_selection').prop("readonly", false);
          }
          else
          {
            $('#min_selection').prop("readonly", true);
            $('#max_selection').prop("readonly", true);
          }
       });
     
   });
   
</script>
@endsection
