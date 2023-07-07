@extends('Admin::layouts.backend')

@section('content')
<!-- Page header -->
   <div class="content">

<div class="content-wrapper">
			<div class="page-header border-bottom-0">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Entities</h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none mb-3 mb-md-0">
						<div class="d-flex justify-content-center">

						</div>
					</div>
				</div>
			</div>
			<!-- /page header -->
	<!-- Scrollable datatable -->
				<div class="card">


					<div class="card-body" width="100%">

                           <a type="button" class="btn btn-outline-success" href="{{route('admin.AddEntityBranch', $data['entity']->uuid)}}" ><i class="icon-plus3"></i> Add New Entity Branch</a>


					</div>
					
					<table class="table datatable-pagination" width="100%">
						<thead>
							<tr>
								<th>Entity Branch ID</th>
                                <th>Branch Title</th>
								<th>Entity Name</th>
								<th>Category</th>
                                <th>Branch Slug</th>
                                <th>Phone</th>
                                <th>Service</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($data['branches'] as $branch)
							<tr>
								<td>{{$branch->id}}</td>
                                <td>{{$branch->title}}</td>
								<td>{{$data['entity']->name}}</td>
								<td>{{$data['entity']->Category->name}}</td>
                                <td>{{ucfirst($branch->slug)}}</td>
                                <td>{{$branch->phone}}</td>
								<td>{{$branch->Service->name}}</td>

                                <td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="{{route('admin.editEntityBranch' , $branch->uuid)}}" class="list-icons-item">
												<i class="btn btn-primary icon-pencil3"></i>
											</a>
                                            |
                                            	<a href="{{ route('admin.deleteEntityBranch',$branch->uuid) }}" class="list-icons-item">
												<i class="btn btn-danger icon-trash"></i>
											</a>


										</div>
									</div>
								</td>
							</tr>

                            @endforeach

						</tbody>
					</table>
				</div>
				<!-- /scrollable datatable -->

                </div>
                </div>


@endsection
