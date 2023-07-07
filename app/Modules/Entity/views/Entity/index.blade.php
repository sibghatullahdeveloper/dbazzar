@extends('Entity::layouts.backend')

@section('content')
    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Entity Info</h4>
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
            <!-- Scrollable datatable -->
            <div class="card">


                <div class="card-body" width="100%">

                    <div class="row">
                        <div class="col-md-4">Entity Name:<strong> {{$entity->name}}</strong></div>
                        <div class="col-md-4">Entity Category:<strong> {{$entity->Category->name}}</strong></div>
                        <div class="col-md-4"><strong> <a type="button" class="btn btn-outline-success" href="{{route('entity.AddEntityBranch',$entity->uuid)}}" ><i class="icon-plus3"></i> Add New Entity Branch</a></strong></div>
                    </div>


                </div>

                <table class="table datatable-scroll-y" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
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
                    @if($data['branches'])
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
                    @endif


                    </tbody>
                </table>
            </div>
            <!-- /scrollable datatable -->

        </div>
    </div>


@endsection
