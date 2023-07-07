@extends('Entity::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">
      
    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Product Categories</span> - Edit Product Category</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
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
                  <div class="col-md-10 offset-md-1">
                    <div class="header-elements-inline">
                      <h5 class="card-title">Edit Product Category Form</h5>
                      <div class="header-elements">
                        <div class="list-icons">
                                  
                                </div>
                              </div>
                            </div>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 offset-md-1">
                    <form action="{{route('entity.updateproductcategory', ['id' => $data->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Product Category Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->name}}" name="name">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Start Time</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <span class="input-group-prepend">
                              <span class="input-group-text"><i class="icon-alarm"></i></span>
                            </span>
                            <input type="text" value="{{$data->start_date_time}}" class="form-control pickatime" placeholder="Pick Time" name="start_time">
                          </div>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">End Time</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            <span class="input-group-prepend">
                              <span class="input-group-text"><i class="icon-alarm"></i></span>
                            </span>
                            <input type="text" value="{{$data->end_date_time}}" class="form-control pickatime" placeholder="Pick Time" name="end_time">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Order By</label>
                        <div class="col-lg-9">
                          <div class="input-group">
                            
                            <input type="number" value="{{$data->order_by}}" class="form-control" placeholder="Order By" name="order_by">
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Status</label>
                        <div class="col-lg-9">
                        <select data-placeholder="" name="status" class="form-control select" data-fouc style="opacity:1;">
                            <option value="1" {{  ($data->status == 1 ? ' selected' : '') }} >Active</option>
                            <option value="0" {{  ($data->status == 0 ? ' selected' : '') }} >InActive</option>
                        </select>
                        </div>
                      </div>


                      <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
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
