@extends('Admin::layouts.backend')

@section('content')
<!-- Page header -->
   <div class="content">
      
<div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Affiliates</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>
      </div>
      <!-- /page header -->
  <!-- Scrollable datatable -->
        <div class="card">
          

          <div class="card-body" width="100%">
            <a type="button" class="btn btn-outline-success" href="{{route('admin.createaffiliates')}}"><i class="icon-plus3"></i> Create Affiliate</a>
          </div>

          <table class="table datatable-scroll-y" width="100%">
            <thead>
              <tr>
                <th>Affiliate ID</th>
                <th>Affiliate Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Affiliate Post</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lists as $info)
               <tr>
                  <td>{{$info->id}}</td>
                  <td>{{$info->name}}</td>
                  <td>{{$info->address}}</td>
                  <td>{{$info->contact}}</td>
                  <td>{{$info->email}}</td>
                  <td>{{$info->affiliate_post_type}}</td>
                  
                  @if ($info->status == 1 )
                    <td><span class="badge badge-success">Active</span></td>
                  @endif
                  @if ($info->status == 0 )
                    <td><span class="badge badge-danger">Inactive</span></td>
                  @endif

                  <td class="text-center">
                  <div class="list-icons">
                    <div class="dropdown">
                      <a href="{{route('admin.editaffiliates', ['uuid' => $info->uuid])}}" class="list-icons-item">
                        <i class="btn btn-primary icon-pencil3"></i>
                      </a>
                      |
                      <a href="{{route('admin.deleteaffiliates', ['id' => $info->id])}}" class="list-icons-item"> {{ method_field('DELETE') }}
    {{ csrf_field() }}
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
