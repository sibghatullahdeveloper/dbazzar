@extends('Admin::layouts.backend')

@section('content')

    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Add New Sponsored</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none mb-3 mb-md-0">
                        <div class="d-flex justify-content-center">
                           
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
                                    <div class="col-md-10 ">
                                        <div class="header-elements-inline">
                                            <h5 class="card-title">Add Sponsored</h5>

                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-right">
                                            <a href="{{route('admin.sponsored')}}" class="btn btn-primary">List Sponsored <i class="icon-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                    <form  action="{{ route('admin.sponsored_add') }}" method="POST" class="needs-validation" novalidate>
                                        {{csrf_field()}}


                                        @if(session()->has('success'))
                                            <div class="alert alert-success">
                                                {{ session()->get('success') }}
                                            </div>
                                        @endif

                                         @if(isset($sponsored->id))
                                             <input type="hidden" value="{{$sponsored->uuid}}" name="sponsored_id">
                                             @endif
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label>Select Entity:</label>
                                                <select data-placeholder="Select Entity Branch" name="entity_branch_id"  required class="form-control form-control-select2" data-fouc style="opacity:1;">
                                                    <option value="">Select Entity Branch</option>
                                                    @foreach($items as $item)
                                                        <option value="{{$item->id}}"  @if(isset($sponsored->entity_branch_id) && $sponsored->entity_branch_id== $item->id)  selected='selected' @endif>{{$item->title}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    select branch
                                                </div>
                                                @if ($errors->has('entity'))
                                                    <div>
                                                        <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('entity') }}</strong>
                                                    </div>
                                                @endif

                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Status:</label>
                                                <select data-placeholder="Select your country" name="status"  class="form-control form-control-select2" data-fouc style="opacity:1;">
                                                    <option value="1" @if (isset($sponsored->status) && $sponsored->status==1) selected='selected'@endif >Active</option>
                                                    <option value="0" @if  (isset($sponsored->status) && $sponsored->status==0) selected='selected'@endif >InActive</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <div>
                                                        <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('status') }}</strong>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="form-label">Start Date:</label>
                                                       <input type="date" class="form-control" required name="start_date" @if(isset($sponsored->start_date))  value="{{\Carbon\Carbon::parse($sponsored->start_date)->format('Y-m-d')}}"  @endif >
                                                         <div class="invalid-feedback">
                                                           Start date is required
                                                         </div>
                                                         @if ($errors->has('start_date'))
                                                             <div>
                                                                 <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('start_date') }}</strong>
                                                             </div>
                                                         @endif
                                                     </div>

                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group ">
                                                         <label class="form-label">End Date:</label>

                                                         <input type="date" class="form-control" required name="end_date" @if(isset($sponsored->end_date))  value="{{\Carbon\Carbon::parse($sponsored->end_date)->format('Y-m-d')}}"  @endif >
                                                         <div class="invalid-feedback">
                                                            End date is required
                                                         </div>
                                                         @if ($errors->has('end_date'))
                                                             <div>
                                                                 <strong style="color: #ef5350; font-size: 80%">{{ $errors->first('end_date') }}</strong>
                                                             </div>
                                                         @endif
                                                     </div>

                                                 </div>
                                             </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">@if(isset($sponsored->id))Update Sponsored @else Add Sponsored @endif <i class="icon-paperplane ml-2"></i></button>
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

