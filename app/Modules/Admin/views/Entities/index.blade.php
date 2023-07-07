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
                </div>
            </div>
            <!-- /page header -->
            <!-- Scrollable datatable -->
            <div class="card" width="100%">


                <div class="card-body" width="100%">

                    <a type="button" class="btn btn-outline-success" href="{{route('admin.AddEntity')}}" ><i class="icon-plus3"></i> Add New Entity</a>
                    <button type="button" class="btn btn-outline-success" >Upload Bulk CSV</button>

                </div>

                <table class="table datatable-pagination" width="100%">
                    <thead>
                    <tr>
                        <th> ID</th>
                        <th> Name</th>
                        <th> Category</th>
                        <th>Status</th>
                        <th>Branches Option</th>
                        <th> Settings</th>
                        <th> Login</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($entities as $entity)
                        <tr>
                            <td>{{$entity->id}}</td>
                            <td>{{$entity->name}}</td>
                            <td>{{$entity->Category->name}}</td>
                            <td>@if($entity->status== 1)<span class="badge badge-success">Active</span> @else <span class="badge badge-danger">In Active</span> @endif</td>
                            <td><a href="{{route('admin.entityBranch', $entity->uuid)}}" class="btn btn-primary"> View <i class=" icon-eye"></i></a></td>
                            <td><a href="{{route('admin.entity_settings_edit', $entity->uuid)}}" class="btn btn-primary"> Settings <i class="icon-cog"></i></a></td>
                            <td><a href="{{route('admin.entityAutoLogin', $entity->uuid)}}" target="_blank" class="btn btn-primary"> Login </a></td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="{{route('admin.editEntity' , $entity->uuid)}}" class="list-icons-item">
                                            <i class="btn btn-primary icon-pencil3"></i>
                                        </a>
                                        |
                                        <a href="{{ route('admin.deleteEntity',$entity->uuid) }}" class="list-icons-item">
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
