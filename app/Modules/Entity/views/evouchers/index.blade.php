@extends('Entity::layouts.backend')

@section('content')
<!-- Page header -->
   <div class="content">
      
<div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - E-Vouchers</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>
      </div>
      <!-- /page header -->
  <!-- Scrollable datatable -->
        <div class="card">
          

          <div class="card-body" width="100%">
            <a type="button" class="btn btn-outline-success" href="{{route('entity.createevouchers')}}"><i class="icon-plus3"></i> Create E-Voucher</a>
          </div>

          <table class="table datatable-scroll-y" width="100%">
            <thead>
              <tr>
                <th>E-Vouchers ID</th>
                <th>E-Vouchers Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lists as $info)
               <tr>
                  <td>{{$info->id}}</td>
                  <td>{{$info->name}}</td>
                  <td>{{$info->description}}</td>
                  
                  @if ($info->status == 1 )
                    <td><span class="badge badge-success">Active</span></td>
                  @endif
                  @if ($info->status == 0 )
                    <td><span class="badge badge-danger">Inactive</span></td>
                  @endif

                  <td>{{$info->created_at}}</td>
                  <td>{{$info->updated_at}}</td>
                  
                  <td class="text-center">
                  <div class="list-icons">
                    <div class="dropdown">
                      <a href="{{route('entity.editevouchers', ['uuid' => $info->uuid])}}" class="list-icons-item">
                        <i class="btn btn-primary icon-pencil3"></i>
                      </a>
                      |
                      <a href="{{route('entity.deleteevouchers', ['id' => $info->id])}}" class="list-icons-item"> {{ method_field('DELETE') }}
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
