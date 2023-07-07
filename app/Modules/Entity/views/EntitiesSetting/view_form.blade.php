@extends('Entity::layouts.backend')
@section('content')

    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Entity Settings </h4>
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
                                            <h5 class="card-title">  {{$data['entity']->name}} Settings</h5>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-right">
                                            <a href="{{route('entity.entity_settings')}}" class="btn btn-primary">List Entity Settings <i class="icon-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form  action="{{route('entity.entity_settings_create_add') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                            {{csrf_field()}}


                                            @if(session()->has('success'))
                                                <div class="alert alert-success">
                                                    {{ session()->get('success') }}
                                                </div>
                                            @endif

                                         
                                              @if(isset($EntitiesSettings->entity->id))
                                                <input type="hidden" value="{{$EntitiesSettings->uuid}}" name="entity_setting_id">
                                                <input type="hidden" value="{{$EntitiesSettings->entity_id}}" name="entity_id">
                                                <input type="hidden" value="{{$EntitiesSettings->branch_id}}" name="branch_id">
                                            @else
                                                <input type="hidden" value="{{$data['entity']->id}}" name="entity_id">
                                            @endif
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    
                                                    <select class="form-control" name="branch_id">
                                                        <option value="">Select a branch</option>
                                                        @foreach($data['branches'] as $branch)
                                                            <option value="{{$branch->id}}" @if(isset($EntitiesSettings)) {{ ( $EntitiesSettings->branch_id == $branch->id) ? 'selected' : '' }} @endif>{{$branch->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Logo</label>
                                                        <input type="file" id="logo" class="form-input-styled "  accept="image/*" name="logo"  >
                                                        @if(isset($EntitiesSettings->logo))
                                                            <img src="{{url('images/entity/' .$EntitiesSettings->logo)}}" class="img-fluid" alt="Responsive image" width="60" height="60" class="rounded-round">
                                                        @endif
                                                    </div>


                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Header</label>
                                                        <input type="file" id="header" class="form-input-styled " accept="image/*" name="header">
                                                        @if(isset($EntitiesSettings->header))
                                                            <img src="{{url('images/entity/' .$EntitiesSettings->header)}}" class="img-fluid" alt="Responsive image" width="60" height="60" class="rounded-round">
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group ">
                                                        <label class="form-label">Commission</label>
                                                         <div class="input-group">
                                                            <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-percent"></i></span>
                                                            </span>
                                                        <input type="number" class="form-control " value="{{old('commission',$EntitiesSettings->commission ?? '')}}" name="commission" required>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Commission is required
                                                        </div>
                                                        @if ($errors->has('commission'))
                                                            <div>
                                                                <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('commission') }}</strong>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Minimum Purchase</label>
                                                        <input type="number" class="form-control " name="minimum_purchase" value="{{old('minimum_purchase',$EntitiesSettings->minimum_purchase ?? '')}}" required>
                                                        <div class="invalid-feedback">
                                                            Minimum Purchase is required
                                                        </div>
                                                        @if ($errors->has('minimum_purchase'))
                                                            <div>
                                                                <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('minimum_purchase') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <div class="form-group ">
                                                        <label class="form-label">Tax</label>
                                                         <div class="input-group">
                                                            <span class="input-group-prepend">
                                                            <span class="input-group-text"><i class="icon-percent"></i></span>
                                                            </span>
                                                        <input type="number" class="form-control " name="tax"  value="{{old('tax',$EntitiesSettings->tax ?? '')}}" required>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Tax is required
                                                        </div>
                                                        @if ($errors->has('tax'))
                                                            <div>
                                                                <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('tax') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>


                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Delivery Time (Minutes)</label>
                                                        <input type="text" class="form-control " name="delivery_time"  value="{{old('delivery_time',$EntitiesSettings->delivery_time ?? '')}}" required>
                                                        <div class="invalid-feedback">
                                                            Delivery Time is required
                                                        </div>
                                                        @if ($errors->has('delivery_time'))
                                                            <div>
                                                                <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('delivery_time') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">

                                                    <label>Menu Type:</label>
                                                    <select data-placeholder="Select your Menu Type" name="menu_type"  class="form-control form-control-select2" data-fouc style="opacity:1;">
                                                        <option value="1" @if (isset($EntitiesSettings->menu_type) && $EntitiesSettings->menu_type==1) selected='selected'@endif >With Picture</option>
                                                        <option value="0" @if  (isset($EntitiesSettings->menu_type) && $EntitiesSettings->menu_type==0) selected='selected'@endif >Without Picture</option>
                                                    </select>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Pre Order</label>
                                                        <div class="form-group row">

                                                            <div class="col-lg-9">
                                                                <div class="form-check form-check-inline">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-input-styled" value="1" name="order_type" @if(isset($EntitiesSettings->order_type) && $EntitiesSettings->order_type==1) checked @endif  data-fouc>
                                                                        Yes
                                                                    </label>
                                                                </div>

                                                                <div class="form-check form-check-inline">
                                                                    <label class="form-check-label">
                                                                        <input type="radio" class="form-input-styled" value="0" name="order_type" @if(isset($EntitiesSettings->order_type) && $EntitiesSettings->order_type==0) checked @endif data-fouc>
                                                                        No
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Packaging Charge Type:</label>
                                                    <select data-placeholder="Select your Packaging Type" name="packaging_type"  class="form-control form-control-select2" data-fouc style="opacity:1;">
                                                        <option value="1" @if (isset($EntitiesSettings->packaging_type) && $EntitiesSettings->packaging_type==1) selected='selected'@endif >Whole Item</option>
                                                        <option value="0" @if  (isset($EntitiesSettings->packaging_type) && $EntitiesSettings->packaging_type==0) selected='selected'@endif >Per Item</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Packaging Charge</label>
                                                        <input type="number" class="form-control " name="packaging_charge"   value="{{old('packaging_charge',$EntitiesSettings->packaging_charge ?? '')}}" required >

                                                        <div class="invalid-feedback">
                                                            Packaging Charge is required
                                                        </div>
                                                        @if ($errors->has('packaging_charge'))
                                                            <div>
                                                                <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('packaging_charge') }}</strong>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Status:</label>
                                                    <select data-placeholder="Select your country" name="status"  class="form-control form-control-select2" data-fouc style="opacity:1;">
                                                        <option value="1" @if (isset($EntitiesSettings->status) && $EntitiesSettings->status==1) selected='selected'@endif >Active </option>
                                                        <option value="0" @if  (isset($EntitiesSettings->status) && $EntitiesSettings->status==0) selected='selected'@endif >InActive</option>
                                                        <option value="2" @if (isset($EntitiesSettings->status) && $EntitiesSettings->status==2) selected='selected'@endif >Temporarily Closed </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                        <label class="form-label">Reason</label>
                                                        <input type="text" class="form-control " name="status_message" value="{{old('status_message',$EntitiesSettings->status_message ?? '')}}" >
                                                       

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-9">
                                                            <label class="form-label "> About</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <button type="button" class="btn btn-primary" id="readOnlyOn" style="display: none;"><i class="icon-eye2 mr-2"></i> Make editor readonly</button>
                                                            <button type="button" class="btn btn-success" id="readOnlyOff" style="display: none;"><i class="icon-eye-blocked2 mr-2"></i> Make it editable</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                    <textarea name="About" id="editor-readonly" rows="5" cols="5" >
                                                        
                                                            {{old('About',$EntitiesSettings->About ?? '')}}
                                                        
                                                    </textarea>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary"> @if(isset($EntitiesSettings->id))Update Setting @else Save Setting @endif<i class="icon-paperplane ml-2"></i></button>
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

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
