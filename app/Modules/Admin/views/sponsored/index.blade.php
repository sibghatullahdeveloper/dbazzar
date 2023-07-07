@extends('Admin::layouts.backend')

@section('content')
    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Sponsored</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none mb-3 mb-md-0">
                        <div class="d-flex justify-content-center">
                                                    </div>
                    </div>
                </div>
            </div>
            <div class="card">


                <div class="card-body" width="100%">

                    <a type="button" class="btn btn-outline-success" href="{{route('admin.sponsored_create')}}" ><i class="icon-plus3"></i> Add New Sponsored</a>

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
                    <th>No</th>

                    <th>Sponsored </th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th class="text-center">Actions</th>

                </tr>
                </thead>
                <tbody>
                @foreach($lists as $list)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>@if($list->entitybranches){{$list->entitybranches->title}}@endif</td>
                    <td>
                        @if($list->status==1)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-danger">InActive</span>
                        @endif
                    </td>
                    <td>

                        {{ \Carbon\Carbon::parse($list->start_date)->format('d-m-Y')}}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($list->end_date)->format('d-m-Y')}}

                    </td>
                    <td class="text-center" style="display: contents;">
                        <div class="list-icons">
                            <div class="dropdown">
                                <a href="{{route('admin.sponsored_edit' , $list->uuid)}}" class="list-icons-item">
                                    <i class="btn btn-primary icon-pencil3"></i>
                                </a>
                                |
                                <a href="{{ route('admin.sponsored_delete',$list->uuid) }}" class="list-icons-item">
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

