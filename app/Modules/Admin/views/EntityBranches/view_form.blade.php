@extends('Admin::layouts.backend')
@section('content')
<!-- Page header -->
<div class="content">
<div class="content-wrapper">
   <div class="page-header border-bottom-0">
      <div class="page-header-content header-elements-md-inline">
         <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - {{$entity->name}} Branches</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
         </div>
         <div class="header-elements d-none mb-3 mb-md-0">
            <div class="d-flex justify-content-center">

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
                           <h5 class="card-title">Add Entity Branch For <strong>{{$entity->name}}</strong></h5>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="text-right">
                           <a href="{{route('admin.entityBranch', $entity->uuid)}}" class="btn btn-primary">List Entities <i class="icon-list"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-10 offset-md-1">
                        <form class="needs-validation" action="{{ route('admin.saveEntityBranch') }}" method="POST" enctype="multipart/form-data"  novalidate>
                           {{csrf_field()}}
                           @if (count($errors) > 0)
                           <div class = "alert alert-danger">
                              @foreach ($errors->all() as $error)
                              <span>{{ $error }}</span><br>
                              @endforeach
                           </div>
                           @endif
                           @if(session()->has('success'))
                           <div class="alert alert-success">
                              {{ session()->get('success') }}
                           </div>
                           @endif
                           <div class=" row">
                              <div class="form-group col-md-6">
                                 <span><strong>Branch Information</strong></span>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label">Branch Title:</label>
                                 <input type="text" name="title" class="form-control" value="{{ old('title', $entity->title ?? '')}}" placeholder="Enter Branch Title">
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Branch Slug:</label>
                                 <input type="text" name="slug" required class="form-control" value="{{ old('slug', $entity->slug ?? '')}}" placeholder="Enter Branch Slug">
                                 <div class="invalid-feedback">
                                    Please choose a username.
                                 </div>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">Branch Phone:</label>
                                 <input type="tel" name="phone" class="form-control" value="{{ old('phone', $entity->phone ?? '')}}" placeholder="Enter Branch Phone">
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <span><strong>Contact Person Information</strong></span>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <textarea rows="3" cols="3" class="form-control"  id="about" name="about" placeholder="About">{{ old('about', $entity->about ?? '')}}</textarea>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label">Header</label>
                                 <input type="file" id="header" class="form-input-styled " accept="image/*" name="header">
                                   @if(isset($header))
                                           <img src="{{url('images/entitybranch/'.$header)}}" class="img-fluid" alt="Responsive image" width="60" height="60" class="rounded-round">
                                   @endif
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label" for="example-select">Gallery Pictures</label>
                                 <input type="file" id="pictures" class="form-input-styled " accept="image/*" name="pictures[]" multiple >
                                 @if(isset($Gallery))
                                 @foreach($Gallery as $photo)
                                           <img src="{{url('images/entitybranch/'.$photo)}}" class="img-fluid" alt="Responsive image" width="60" height="60" class="rounded-round">
                                  @endforeach
                                   @endif
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label">Contact Name:</label>
                                 <input type="text" name="contact_name" value="{{ old('contact_name', $contact[0]['name'] ?? '')}}" class="form-control" placeholder="Enter Contact Name">
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Contact Phone:</label>
                                 <input type="tel" name="contact_phone" value="{{ old('contact_phone', $contact[0]['phone'] ?? '')}}" class="form-control" placeholder="Enter Contact Phone">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">Contact Email:</label>
                                 <input type="email" name="contact_email" value="{{ old('contact_email', $contact[0]['email'] ?? '')}}" class="form-control" placeholder="Enter Contact Email">
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <span><strong>Address Information</strong></span>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label">Street No:</label>
                                 <input type="text" name="street_no" value="{{ old('street_no', $address[0]['street_no'] ?? '')}}" class="form-control" placeholder="Enter Street No">
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Country:</label>
                                 <select data-placeholder="Select a Country..." id="select_country" name="country" class="form-control form-control-lg select-search" data-container-css-class="select-lg" data-fouc>
                                    <option value=""></option>
                                    @foreach($countries as $val)
                                    <option value="{{$val->id}}" @if(isset($address)) {{ ( $val->id == $address[0]['country']) ? 'selected' : '' }} @endif>{{$val->country}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">City:</label>
                                 <select data-placeholder="Select a City..." id="select_city" name="city" class="form-control form-control-lg select-search" data-container-css-class="select-lg" data-fouc>
                                    <option value=""></option>
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Zip Code:</label>
                                 <input type="text" name="zip_code" value="{{ old('zip_code', $address[0]['zip_code'] ?? '')}}" class="form-control" placeholder="Enter Zip Code">
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">State:</label>
                                 <input type="text" name="state" value="{{ old('state', $address[0]['state'] ?? '')}}" class="form-control" placeholder="Enter State">
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <span><strong>Timings & Other Info</strong></span>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-3">
                                 <label class="form-label">Sunday Start Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="sun_start" value="{{ old('sun_start', $timmings['sun_start'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Sunday End Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="sun_end" value="{{ old('sun_end', $timmings['sun_end'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Monday Start Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="mon_start" value="{{ old('mon_start', $timmings['mon_start'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Monday End Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="mon_end" value="{{ old('mon_end', $timmings['mon_end'] ?? '')}}">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-3">
                                 <label class="form-label">Tuesday Start Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="tue_start" value="{{ old('tue_start', $timmings['tue_start'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Tuesday End Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="tue_end" value="{{ old('tue_end', $timmings['tue_end'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Wednesday Start Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="wed_start" value="{{ old('wed_start', $timmings['wed_start'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Wednesday End Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="wed_end" value="{{ old('wed_end', $timmings['wed_end'] ?? '')}}">
                                 </div>
                              </div>
                           </div>
                            <div class="row">
                              <div class="form-group col-md-3">
                                 <label class="form-label">Thursday Start Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="thus_start" value="{{ old('thus_start', $timmings['thus_start'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Thursday End Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="thus_end" value="{{ old('thus_end', $timmings['thus_end'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Friday Start Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="fri_start" value="{{ old('fri_start', $timmings['fri_start'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Friday End Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="fri_end" value="{{ old('fri_end', $timmings['fri_end'] ?? '')}}">
                                 </div>
                              </div>
                           </div>
                             <div class="row">
                              <div class="form-group col-md-3">
                                 <label class="form-label">Saturday Start Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="sat_start" value="{{ old('sat_start', $timmings['sat_start'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Saturday End Time:</label>
                                 <div class="input-group">
                                    <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-alarm"></i></span>
                                    </span>
                                    <input type="text" class="form-control pickatime" placeholder="Pick Time" name="sat_end" value="{{ old('sat_end', $timmings['sat_end'] ?? '')}}">
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                
                              </div>
                              <div class="form-group col-md-3">
                                
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Delivery Type:</label>
                                 <select data-placeholder="Select a Delivery Type..." name="delivery_type" class="form-control form-control-lg select" data-container-css-class="select-lg" data-fouc>
                                    <option value=""></option>
                                    <option value="own" @if(isset($entity)) {{ ( "own" == $entity->delivery_type) ? 'selected' : '' }} @endif>Own</option>
                                    <option value="system" @if(isset($entity)) {{ ( "system" == $entity->delivery_type) ? 'selected' : '' }} @endif>System</option>
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">Delivery Charge:</label>
                                 <input type="text" class="form-control" placeholder="Delivery Charges" name="delivery_charge" value="{{ old('delivery_charge', $entity->delivery_charge ?? '')}}">
                              </div>
                           </div>
                            <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label">Assign Affiliate:</label>
                                 <select data-placeholder="Assign an Affiliate..." name="affiliate" class="form-control form-control-lg select-search" onclose="preventDefault(e)" close="false">
                                    <option value=""></option>
                                    @foreach($affiliates as $val)
                                   
                                    <option value="{{$val->id}}" @if(isset($entity)) {{ ( $val->id == $entity->affiliate_id) ? 'selected' : '' }} @endif>{{$val->name}}</option>
                                  
                                    @endforeach 
                                 </select>
                              </div>
                           </div>

                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label class="form-label">Tags:</label>
                                 <select data-placeholder="Select Tags..." name="tags[]" class="form-control select-multiple-drag" onclose="preventDefault(e)" close="false" multiple="multiple">
                                    <option value=""></option>
                                    @foreach($tags as $val)
                                    @if(in_array($val->id,$tagsArray))
                                    <option value="{{$val->id}}" selected>{{$val->name}}</option>
                                    @else
                                    <option value="{{$val->id}}" >{{$val->name}}</option>
                                    @endif
                                    @endforeach 
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <span><strong>Services & Cuisines</strong></span>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Services:</label>
                                 <select data-placeholder="Select a Service..." name="service_id" class="form-control form-control-lg select" data-container-css-class="select-lg" data-fouc>
                                    <option value=""></option>
                                    @foreach($services as $val)
                                    <option value="{{$val->id}}" @if(isset($entity)) {{ ( $val->id == $entity->service_id) ? 'selected' : '' }} @endif>{{$val->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">Cuisines:</label>
                                 <select data-placeholder="Select a Cuisine..." name="cuisines[]" class="form-control select-multiple-drag" onclose="preventDefault(e)" close="false" multiple="multiple">
                                    <option value=""></option>
                                    @foreach($cuisines as $val)
                                    @if(in_array($val->id,$cuisinesArray))
                                    <option value="{{$val->id}}" selected>{{$val->name}}</option>
                                    @else
                                    <option value="{{$val->id}}" >{{$val->name}}</option>
                                    @endif
                                    @endforeach 
                                 </select>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <span><strong>Current Location & Geo Fencing</strong></span>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Geo Fencing:</label>
                                 <br><br>
                                 <div class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#GeofenceModel">
                                    <i class="fa fa-times-circle-o"></i>
                                    Draw Geo Fence On Map
                                 </div>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">Geo Fencing Location:</label>
                                 <textarea rows="3" cols="3" class="form-control"  readonly id="geofencing" name="geofencing" placeholder="Default textarea">{{ old('geofencing', $entity->geofencing ?? '')}}</textarea>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Current Location:</label>
                                 <br>
                                 <div class="btn btn-primary btn-lg" role="button" data-toggle="modal" data-target="#map_currentLocation">
                                    <i class="fa fa-times-circle-o"></i>
                                    Select Current Location On Map
                                 </div>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Latitude:</label>
                                 <input type="text" name="entity_lat" value="{{ old('entity_lat', $entity->entity_lat ?? '')}}" class="form-control" placeholder="Latitude" readonly>
                              </div>
                              <div class="form-group col-md-3">
                                 <label class="form-label">Logitude:</label>
                                 <input type="text" name="entity_long" value="{{ old('entity_lat', $entity->entity_lat ?? '')}}" class="form-control" placeholder="Longitude" readonly>
                              </div>
                           </div>
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Status:</label>
                                 <select data-placeholder="Select a Status..." id="status_id" name="status_id" class="form-control form-control-lg select" data-container-css-class="select-lg" data-fouc>
                                    <option value=""></option>
                                    @foreach($status as $val)
                                    <option value="{{$val->id}}" @if(isset($entity)) {{ ( $val->id == $entity->status_id) ? 'selected' : '' }} @endif>{{$val->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="form-group col-md-6">
                                
                                 <label class="form-label">  Publish Merchant
                                 </label>
                                 <select data-placeholder="Select a Status..." id="publish_merchant" name="publish_merchant" class="form-control form-control-lg select" data-container-css-class="select-lg" data-fouc>
                                    <option value=""></option>
                                  
                                    <option value="1" @if(isset($entity)) {{ ( 1 == $entity->publish_merchant) ? 'selected' : '' }} @endif>Yes</option>
                                   <option value="0" @if(isset($entity)) {{ ( 0 == $entity->publish_merchant) ? 'selected' : '' }} @endif>No</option>
                                 </select>
                              </div>
                           </div>
                           <input type="hidden" name="uuid" value="{{ old('uuid', $entity->uuid ?? '')}}">
                           <input type="hidden" name="branch_uuid" value="{{$entity->branch_uuid}}">
                           <div class="text-right">
                              <button type="submit" class="btn btn-primary">Save <i class="icon-paperplane ml-2"></i></button>
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
<div class="modal fade" id="GeofenceModel" role="dialog" aria-labelledby="modalLabel" tabindex="-1">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Draw Geo Fencing</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body" style="width: 540px; height: 500px;">
            <div class="map-container" id="map_geolocation"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div id="map_currentLocation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Pin Your Location</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
         </div>
         <div class="modal-body">
            <div id="map_canvas" style="width: 490px;height: 460px;"></div>
            <div id="current">Nothing yet...</div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<script>
   // Initialize and add the map
   function initMap() {
       // The location of Uluru
       var uluru = {lat: -25.344, lng: 131.036};
       // The map, centered at Uluru
       var map = new google.maps.Map(
           document.getElementById('map'), {zoom: 4, center: uluru});
       // The marker, positioned at Uluru
       var marker = new google.maps.Marker({position: uluru, map: map});
   }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKuPKvQgXplnAGAblaK7mOT5HoQKAfqaU&libraries=drawing&callback=initMap" async defer></script>
<script type="text/javascript">
   $(document).ready(function() {
   
     $(".btn-success").click(function(){ 
         var html = $(".clone").html();
         $(".increment").after(html);
     });
   
     $("body").on("click",".btn-danger",function(){ 
         $(this).parents(".control-group").remove();
     });
   
   });
   
</script>
<script>
   (function() {
       'use strict';
       window.addEventListener('load', function() {
   // Fetch all the forms we want to apply custom Bootstrap validation styles to
           var forms = document.getElementsByClassName('needs-validation');
   // Loop over them and prevent submission
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
   
   
   
       $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   });
   
   
   
     <?php if(isset($address[0]['country'])){ ?>
       var id = <?php echo $address[0]['country']?>;
         //alert(id);
   
             $.ajax({
               url: '{{route('admin.getCities')}}',
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
                           var selected_city = <?php echo $address[0]['city']?>;
                          // alert(selected_city);
                           var option = '<option value="'+id+'">'+name+'</option>';
                           $('#select_city').val(selected_city);
                           $("#select_city").append(option);
                       }
                   }
   
               }
           });
   
       <?php } else { ?>
       // Department Change
       $('#select_country').change(function(){
   
           // Department id
           var id = $(this).val();
   
           // Empty the dropdown
           $('#select_city').find('option').not(':first').remove();
   
           // AJAX request
           $.ajax({
               url: '{{route('admin.getCities')}}',
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
   
                           $("#select_city").append(option);
                       }
                   }
   
               }
           });
       });
     <?php } ?>
   });
   
</script>
@endsection