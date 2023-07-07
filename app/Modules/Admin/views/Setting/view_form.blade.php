@extends('Admin::layouts.backend')
@section('content')

    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Admin Settings </h4>
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
            <!-- /page header -->
            <div class="content">
                <!-- Centered forms -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9 ">
                                        <div class="header-elements-inline">
                                            <h5 class="card-title">Admin Settings</h5>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-right">
                                            <a href="{{route('admin.entity_settings')}}" class="btn btn-primary">Admin Settings <i class="icon-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form  action=" @if(isset($settings->uuid)) {{route('admin.settings_create_add',$settings->uuid)}} @else {{route('admin.settings_create_add')}} @endif " method="POST" enctype="multipart/form-data">
                                            {{csrf_field()}}

                                            @if (count($errors) > 0)
                                                <div class = "alert alert-danger">
                                                    @foreach ($errors->all() as $error)
                                                        <span>{{ $error }}</span><br>
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if(session()->has('success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('success') }}
                                                </div>
                                            @endif

                                            @if(isset($settings->uuid))
                                                <input type="hidden" value="{{$settings->uuid}}" name="settings_uuid">
                                            @endif

                                              <div class="row">

                                                  <div class="col-md-12" style="display: contents;">
                                                      <div class="col-md-3">
                                                          <label>Website Status:</label>
                                                      </div>
                                                      <div class="col-md-3">
                                                          <select data-placeholder="Select your country" name="status"  class="form-control form-control-select2" data-fouc style="opacity:1;">
                                                              <option value="1" @if (isset($settings->status) && $settings->status==1) selected='selected'@endif >Up </option>
                                                              <option value="0" @if  (isset($settings->status) && $settings->status==0) selected='selected'@endif >Down</option>
                                                          </select>
                                                      </div>
                                                      <div class="col-md-6"></div>
                                                  </div>
                                                </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary"> @if (isset($settings->uuid)) Update Setting @else Save Setting @endif<i class="icon-paperplane ml-2"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
