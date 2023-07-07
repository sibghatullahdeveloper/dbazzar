@extends('Admin::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">

    <div class="content-wrapper">
			<div class="page-header border-bottom-0">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Add New Entity</h4>
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
											<h5 class="card-title">Add Entity</h5>

					                	</div>
									</div>
                                    <div class="col-md-2">
                                      <div class="text-right">
												<a href="{{route('admin.entities')}}" class="btn btn-primary">List Entities <i class="icon-list"></i></a>
											</div>
                                    </div>
								</div>
							</div>

							<div class="card-body">
								<div class="row">

									<div class="col-md-10 offset-md-1">
										  <form class="" action="{{ route('admin.saveEntity') }}" method="POST">
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
											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Select Category:</label>
												<div class="col-lg-9">

                                                <select data-placeholder="Select a Category..." name="entity_cat" class="form-control form-control-lg select" data-container-css-class="select-lg" data-fouc>
										           <option value=""></option>
										             @foreach($catorgies as $cat)
											        <option value="{{$cat->id}}" @if(isset($entity)) {{ ( $cat->id == $entity->Category->id) ? 'selected' : '' }} @endif>{{$cat->name}}</option>
                                                    @endforeach

								            	</select>

												</div>
											</div>

											<div class="form-group row">
												<label class="col-lg-3 col-form-label">Entity Name:</label>
												<div class="col-lg-9">
													<input type="text" name="entity_name" value="{{ old('entity_name', $entity->name ?? '')}}" class="form-control" placeholder="Enter Entity Name">
												</div>
											</div>

                                              <div class="row">
                                                  <div class="form-group col-md-12">
                                                      <span><strong>Entity Admin Login  Information</strong></span>
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label class="col-lg-3 col-form-label">Entity Email :</label>
                                                  <div class="col-lg-9">
                                                      <input type="email" name="entity_email" value="{{ old('entity_email', $entity->Userinfo->email ?? '')}}" class="form-control" placeholder="Enter Entity Email">
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <label class="col-lg-3 col-form-label">Password:</label>
                                                  <div class="col-lg-9">
                                                      <input type="password" name="password"  class="form-control" placeholder="Enter Entity Password">
                                                  </div>
                                              </div>




                                              <div class="form-group row">
												<label class="col-lg-3 col-form-label">Entity Status:</label>
												<div class="col-lg-9">
													 <select data-placeholder="Select a Category..." name="status" class="form-control form-control-lg select" data-container-css-class="select-lg" data-fouc>

											        <option value="1"  @if(isset($entity)) {{ ( $entity->status == 1) ? 'selected' : '' }} @endif>Active</option>
                                                     <option value="0" @if(isset($entity)) {{ ( $entity->status == 0) ? 'selected' : '' }} @endif>In Active</option>


								            	</select>


												</div>
											</div>
                                            <input type="hidden" name="uuid" value="{{ old('uuid', $entity->uuid ?? '')}}">
                                            <input type="hidden" name="user_id" value="{{old('user_id', $entity->user->user_id ?? '')}}">
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

@endsection
