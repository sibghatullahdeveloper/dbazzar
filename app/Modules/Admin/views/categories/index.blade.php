@extends('Admin::layouts.backend')

@section('content')
    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Categories</h4>
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
            <div class="card">


                <div class="card-body" width="100%">

                    <a type="button" class="btn btn-outline-success" href="{{route('admin.categories_create')}}" ><i class="icon-plus3"></i> Add New Category</a>
                    <button type="button" class="btn btn-outline-success" >Upload Bulk CSV</button>
                    <a type="button" class="btn btn-outline-success" href="{{route('admin.categories')}}" ><i class="icon-plus3"></i>List</a>

                </div>
            <!-- /page header -->
            <!-- Scrollable datatable -->
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
            @endif
            <!-- /scrollable datatable -->
            <table class="table datatable-pagination">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th class="text-center">Actions</th>

                </tr>
                </thead>
                <tbody>
                @foreach($lists as $list)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td> {{$list->id}}</td>
                    <td>{{$list->name}}</td>
                    <td>
                        @if($list->status==1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">InActive</span>
                        @endif
                    </td>
                    <td>
                        {{$list->created_at}}
                    </td>

                    <td class="text-center" style="display: contents;">
                        <div class="list-icons">
                            <div class="dropdown">
                                <a href="{{ route('admin.category_edit', ['id' => $list->uuid]) }}" class="list-icons-item">
                                    <i class="btn btn-primary icon-pencil3"></i>
                                </a>
                                |
                                <a href="{{ route('admin.category_delete', ['id' => $list->uuid]) }}" class="list-icons-item">
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
        </div>
    </div>

@endsection

