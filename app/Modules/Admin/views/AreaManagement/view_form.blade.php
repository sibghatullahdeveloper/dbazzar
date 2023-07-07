@extends('Admin::layouts.backend')

@section('content')

    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> -  @if(isset($AreaManagementService->id)) Update Area  @else Add Area  @endif </h4>
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
                                    <div class="col-md-9">
                                        <div class="header-elements-inline">
                                            <h5 class="card-title">@if(isset($AreaManagementService)) Update Area  @else Add Area  @endif </h5>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="text-right">
                                            <a href="{{route('admin.area_management')}}" class="btn btn-primary">List Area  <i class="icon-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                    <form  action="{{ route('admin.area_management_add') }}" method="POST" class="needs-validation" novalidate>
                                        {{csrf_field()}}

                                        @if(session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif

                                         @if(isset($AreaManagementService->id))
                                             <input type="hidden" value="{{$AreaManagementService->uuid}}" name="uuid">
                                             @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Area Name:</label>
                                            <input type="text" class="form-control" name="name"   value="@if (isset($AreaManagementService->name)) {{$AreaManagementService->name}}@endif" placeholder="Enter Area Manager Name"  required>
                                            <div class="invalid-feedback">
                                                Area  name is required
                                            </div>
                                            @if ($errors->has('name'))
                                                <div>
                                                    <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('name') }}</strong>
                                                </div>
                                            @endif

                                        </div>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status:</label>
                                            <select data-placeholder="Select your country" name="status"  class="form-control form-control-select2" data-fouc style="opacity:1;">
                                                <option value="1" @if (isset($AreaManagementService->status) && $AreaManagementService->status==1) selected='selected'@endif >Active</option>
                                                <option value="0" @if  (isset($AreaManagementService->status) && $AreaManagementService->status==0) selected='selected'@endif >InActive</option>

                                            </select>
                                        </div>
                                </div>
                            </div>



                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label class="form-label">Country:</label>


                                                <select data-placeholder="Select a Country..." id="select_country" name="country_id" class="form-control form-control-lg select-search" data-container-css-class="select-lg" data-fouc>
                                                    <option value=""></option>
                                                    @foreach($countries as $val)
                                                        <option value="{{$val->id}}" @if(isset($AreaManagementService->country_id) && $AreaManagementService->country_id==$val->id) selected="selected" @else  @endif>{{$val->country}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="form-label">City:</label>
                                                <select data-placeholder="Select a City..." id="select_city" name="city_id" class="form-control form-control-lg select-search" data-container-css-class="select-lg" data-fouc>
                                                    <option value=""></option>
                                                </select>
                                                
                                                <input type="hidden" id="city_val" @if(isset($AreaManagementService->city_id)) value="{{$AreaManagementService->city_id}}" @endif>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">     @if(isset($AreaManagementService->id))Update Area  @else Add Area  @endif <i class="icon-paperplane ml-2"></i></button>
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
    <script type='text/javascript'>
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


        $('#select_country').change(function(){
            var id = $(this).val();
            $('#select_city').find('option').not(':first').remove();
            $.ajax({
                url: '{{route('admin.getCities')}}',
                type: 'post',
                data:{"_token": "{{ csrf_token() }}",id:id},
                dataType: 'json',
                success: function(response){
                    console.log(response,"result");
                    var len = 0;
                    if(response != null){
                        len = response.length;
                    }
                    console.log(len, response);
                    if(len > 0){
                        // Read data and create <option >
                        for(var i=0; i<len; i++){
                            var id = response[i].id;
                            var name = response[i].name;
                            var option = "<option value='"+id+"'>"+name+"</option>";
                            $("#select_city").append(option);
                        }
                    }

                }
            });
        });

if( $('#select_country').val() !=null){
    var id =$('#select_country').val();
    var city_id =$('#city_val').val();

    $('#select_city').find('option').not(':first').remove();
    $.ajax({
        url: '{{route('admin.getCities')}}',
        type: 'post',
        data:{"_token": "{{ csrf_token() }}",id:id},
        dataType: 'json',
        success: function(response){
            console.log(response,"result");
            var len = 0;
            if(response != null){
                len = response.length;
            }
            console.log(len, response);
            if(len > 0){
                // Read data and create <option >
                for(var i=0; i<len; i++){
                    var id = response[i].id;
                    var name = response[i].name;
                    if(id==city_id){
                        var option = "<option value='"+id+"' selected='selected'>"+name+"</option>";
                    }else{
                        var option = "<option value='"+id+"'>"+name+"</option>";
                    }
                    $("#select_city").append(option);
                }
            }

        }
    });
}
    </script>
@endsection
