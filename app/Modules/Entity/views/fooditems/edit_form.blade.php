@extends('Entity::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">

    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Food Items</span> - Edit Food Items</h4>
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
                      <h5 class="card-title">Edit Food Items Form</h5>
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
                    <form action="{{route('entity.updatefooditems', ['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Food Item Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->name}}" name="name">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Description</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->description}}" name="description">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Price</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->price}}" name="price">
                        </div>
                      </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Display Price</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Display Price" value="{{$data->display_price}}" name="display_price">

                            </div>
                        </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Discount</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->discount}}" name="discount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Image</label>
                        <div class="col-lg-9">
                        @if(isset($data->image))
                                           <img src="{{url('images/foodItems_images/'.$data->image)}}" class="img-fluid" alt="Responsive image" width="60" height="60" class="rounded-round">
                         @endif

                          <input type="file" class="form-control" value="" name="image">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Order By</label>
                        <div class="col-lg-9">
                          <input type="number" value="{{$data->order_by}}" class="form-control" name="order_by">
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Select Add On Cat</label>
                        <select data-placeholder="Select Multiple" class="form-control select" name="addons_ids[]" data-fouc multiple>
                          <optgroup label="Add Ons">

                          @foreach($addons as $addon)

                            @if($FindAddOns != null && in_array($addon->id, $FindAddOns))
                              <option value="{{$addon->id}}" selected>{{$addon->name}}-{{$addon->description}}</option>
                            @else
                              <option value="{{$addon->id}}">{{$addon->name}} {{$addon->description}}</option>
                            @endif
                          @endforeach
                          </optgroup>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Select Product Categories</label>
                        <select data-placeholder="Select Multiple" class="form-control select" name="p_cat_ids" data-fouc>
                          <optgroup label="Product Categories">
                          @foreach($p_cat as $pcat)

                                <option value="{{$pcat->id}}" @if(isset($data)) {{ ( $pcat->id == $data->p_cat_id ) ? 'selected' : '' }} @endif>{{$pcat->name}}</option>

                          @endforeach
                          </optgroup>
                        </select>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Status</label>
                        <div class="col-lg-9">
                        <select data-placeholder="" name="status" class="form-control select" data-fouc>
                            <option value="1" {{  ($data->status == 1 ? ' selected' : '') }} >Active</option>
                            <option value="0" {{  ($data->status == 0 ? ' selected' : '') }} >InActive</option>
                        </select>
                        </div>
                      </div>

                      <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit form<i class="icon-paperplane ml-2"></i></button>
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
