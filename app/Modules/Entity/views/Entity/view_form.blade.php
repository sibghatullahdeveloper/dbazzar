@extends('Entity::layouts.backend')

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
											<h5 class="card-title">Add Entity Branch For <strong>{{$entity->name}}</strong></h5>

					                	</div>
									</div>
                                    <div class="col-md-2">
                                      <div class="text-right">
												<a href="{{route('entity.entityInfo', $entity->uuid)}}" class="btn btn-primary">List Entities <i class="icon-list"></i></a>
											</div>
                                    </div>
								</div>
							</div>

							<div class="card-body">
								<div class="row">

									<div class="col-md-10 offset-md-1">
										  <form class="" action="{{ route('entity.saveEntityBranch') }}" method="POST">

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

													<input type="text" name="title" class="form-control" placeholder="Enter Branch Title">

                                                </div>

                                            </div>


											<div class="row">
                                                <div class="form-group col-md-6">
												<label class="form-label">Branch Slug:</label>

													<input type="text" name="slug" class="form-control" placeholder="Enter Branch Slug">

                                                </div>

                                                <div class="form-group col-md-6">
												<label class="form-label">Branch Phone:</label>

													<input type="tel" name="phone" class="form-control" placeholder="Enter Branch Phone">

                                                </div>
											</div>
                                            <div class="row">
                                            <div class="form-group col-md-12">
                                                <span><strong>Contact Person Information</strong></span>
                                            </div>
                                            </div>

                                            <div class="row">
                                             <div class="form-group col-md-12">
												<label class="form-label">Contact Name:</label>

													<input type="text" name="contact_name" class="form-control" placeholder="Enter Contact Name">

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6">
												<label class="form-label">Contact Phone:</label>

													<input type="tel" name="contact_phone" class="form-control" placeholder="Enter Contact Phone">

                                                </div>

                                                <div class="form-group col-md-6">
												<label class="form-label">Contact Email:</label>

													<input type="email" name="contact_email" class="form-control" placeholder="Enter Contact Email">


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

													<input type="text" name="street_no" class="form-control" placeholder="Enter Street No">
												</div>


                                            </div>

                                                 <div class="row">
                                                <div class="form-group col-md-6">
												<label class="form-label">Country:</label>

													<input type="text" name="country" class="form-control" placeholder="Enter Contact">

                                                </div>

                                                <div class="form-group col-md-6">
												<label class="form-label">City:</label>

													<input type="text" name="city" class="form-control" placeholder="Enter City">


                                                </div>
                                                </div>

                                                 <div class="row">
                                                <div class="form-group col-md-6">
												<label class="form-label">Zip Code:</label>

													<input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code">

                                                </div>

                                                <div class="form-group col-md-6">
												<label class="form-label">State:</label>

													<input type="text" name="state" class="form-control" placeholder="Enter State">


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
                                                              <option value="{{$val->id}}" >{{$val->name}}</option>
                                                          @endforeach

                                                      </select>

                                                  </div>

                                                  <div class="form-group col-md-6">
                                                      <label class="form-label">Cuisines:</label>

                                                      <select data-placeholder="Select a Cuisine..." name="cuisines[]" class="form-control select-multiple-drag" multiple="multiple">
                                                          <option value=""></option>
                                                          @foreach($cuisines as $val)
                                                              <option value="{{$val->id}}" >{{$val->name}}</option>
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


                                                          <textarea rows="3" cols="3" class="form-control" readonly id="geofencing" name="geofencing" placeholder="Default textarea"></textarea>



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
                                                      <input type="text" name="entity_lat" class="form-control" placeholder="Latitude" readonly>
                                                  </div>
                                                  <div class="form-group col-md-3">
                                                      <label class="form-label">Logitude:</label>
                                                      <input type="text" name="entity_long" class="form-control" placeholder="Longitude" readonly>
                                                  </div>
                                              </div>
                                                <input type="hidden" name="uuid" value="{{ old('uuid', $entity->uuid ?? '')}}">
                                            <input type="hidden" name="branch_uuid" value="">

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

@endsection
