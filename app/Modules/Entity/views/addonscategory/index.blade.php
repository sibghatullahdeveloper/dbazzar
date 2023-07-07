@extends('Entity::layouts.backend')

@section('content')
<!-- Page header -->
   <div class="content">
      
<div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Add On Category</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>
      </div>
      <!-- /page header -->
  <!-- Scrollable datatable -->
        <div class="card">
          

          <div class="card-body" width="100%">
            <a type="button" class="btn btn-outline-success" href="{{route('entity.createaddonscategory')}}"><i class="icon-plus3"></i> Create Add Ons Category</a>
          </div>

          <table class="table datatable-scroll-y" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Add Ons Category Name</th>
                <th>Description</th>
                <th>Order By</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($lists as $info)
               <tr>
                  <td>{{$info->id}}</td>
                  <td>{{$info->name}}</td>
                  <td>{{$info->description}}</td>
                  <td>{{$info->order_by}}</td>
                  @if ($info->status == 1 )
                    <td><span class="badge badge-success">Active</span></td>
                  @endif
                  @if ($info->status == 0 )
                    <td><span class="badge badge-danger">Inactive</span></td>
                  @endif

                  <td class="text-center">
                  <div class="list-icons">
                    <div class="dropdown">
                      <a href="{{route('entity.editaddonscategory', ['uuid' => $info->uuid])}}" class="list-icons-item">
                        <i class="btn btn-primary icon-pencil3"></i>
                      </a>
                      |
                      <a href="{{route('entity.deleteaddonscategory', ['id' => $info->id])}}" class="list-icons-item"> {{ method_field('DELETE') }}
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
