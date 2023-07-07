@extends('Affiliate::layouts.backend')

@section('content')
    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Entities List</h4>
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
                  
              
                </div>


                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
            @endif

            <!-- /page header -->
            <!-- Scrollable datatable -->

            <!-- /scrollable datatable -->
            <table class="table datatable-pagination">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Entity Name</th>
                    <th>Affiliate</th>
                    <th>Type</th>
                    <th>Affiliate Email</th>
                    <th>Affiliate Status</th>

                </tr>
                </thead>
                <tbody>
                @foreach($lists as $list)
                <tr>
                    <td>{{$list['id']}}</td>
                    <td>{{$list['title']}}</td>
                    <td>{{$list['affiliate']['name']}}</td>
                    <td>{{$list['affiliate']['affiliate_post_type']}}</td>
                    <td>
                       {{$list['affiliate']['email']}}
                    </td>
                    <td>@if($list['affiliate']['status']== 1)<span class="badge badge-success">Active</span> @else <span class="badge badge-danger">In Active</span> @endif</td>

                </tr>
        @endforeach


                </tbody>
            </table>

            </div>
        </div>
    </div>

@endsection

