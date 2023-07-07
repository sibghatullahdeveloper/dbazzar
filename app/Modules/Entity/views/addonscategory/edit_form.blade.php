@extends('Entity::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">
      
    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Add Ons Categories</span> - Edit Add Ons Category</h4>
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
                      <h5 class="card-title">Edit Add Ons Category Form</h5>
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
                    <form action="{{route('entity.updateaddonscategory', ['id' => $data->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Add Ons Category Name</label>
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
                      <div class="form-group">
                        <label>Required</label>
                         <input type="number" class="form-control" placeholder="Required" maxlength="2" value="{{$data->required}}" name="required" id="required" >
                      </div>
                      <div class="form-group">
                        <label>Order By</label>
                         <input type="number" class="form-control" placeholder="Order By" maxlength="2" value="{{$data->order_by}}" name="order_by" >
                      </div>

                       <div class="form-group">
                        <label>Select Add On Selection Type</label>
                        <select data-placeholder="Select Selection Type" class="form-control select" id="selection_type" name="selection_type" data-fouc>
                          <option value="SINGLE" @if($data->selection_type == 'SINGLE') selected @endif>Single</option>
                          <option value="MULTI" @if($data->selection_type == 'MULTI') selected @endif>Multiple</option>
                        </select>
                      </div>
                         <div class="row">
                              <div class="form-group col-md-6">
                                 <label class="form-label">Minimum Selection:</label>
                                <input type="number" class="form-control" placeholder="Minimum" value="{{$data->min_selection}}" maxlength="2" name="min_selection" id="min_selection" readonly>
                              </div>
                              <div class="form-group col-md-6">
                                 <label class="form-label">Maximum Selection:</label>
                                 <input type="number" class="form-control" placeholder="Maximum" value="{{$data->max_selection}}" maxlength="2" name="max_selection" id="max_selection" readonly >
                              </div>
                           </div>
                      <div class="form-group">
                        <label>Select Add Ons</label>
                        <select data-placeholder="Select Multiple" class="form-control select" name="addons_id[]" data-fouc multiple>
                          <optgroup label="Add Ons">
                          @foreach($addons as $addon)
                          @if($selectedAddon != null && in_array($addon->id,$selectedAddon))
                            <option value="{{$addon->id}}" selected>{{$addon->name}} - {{$addon->price}}</option>
                           @else
                           <option value="{{$addon->id}}">{{$addon->name}} - {{$addon->price}}</option>
                           @endif 
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
