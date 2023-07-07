@extends('Admin::layouts.backend')

@section('content')

<!-- Page header -->
   <div class="content">
      
    <div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Affiliates</span> - Edit Affiliate</h4>
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
                      <h5 class="card-title">Edit Affiliate Form</h5>
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
                    <form action="{{route('admin.updateaffiliates', ['uuid' => $data->uuid])}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Affiliate Name</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->name}}" name="name">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Address</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->address}}" name="address">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Contact</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->contact}}" name="contact">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" value="{{$data->email}}" name="email">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Login's Password</label>
                        <div class="col-lg-9">
                          <input type="password" class="form-control" name="password">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Affiliate Post Type</label>
                        <div class="col-lg-9">
                        <select data-placeholder="" id="Affiliate_Post_Type" name="affiliate_post_type" class="form-control select" data-fouc style="opacity:1;">

                            <option value="AM" {{  ($data->affiliate_post_type == 'AM' ? ' selected' : '') }} >Area Manager</option>
                            <option value="SAM" {{  ($data->affiliate_post_type == 'SAM' ? ' selected' : '') }} >Sub Area Manager</option>
                            <option value="AF" {{  ($data->affiliate_post_type == 'AF' ? ' selected' : '') }} >Affiliate</option>
                        </select>
                        </div>
                      </div>

                      <div class="form-group" style="display:none;" id="select_area1">
                        <label>Select Area</label>
                        <select data-placeholder="Select" class="form-control select" id="select_area" name="area_id"  data-fouc>
                           <optgroup label="Areas">
                          @foreach($areas as $area)
                            <option value="{{$area->id}}" {{  ($data->area_id ==  $area->id ? ' selected' : '') }} >{{$area->name}}</option>
                          @endforeach
                          </optgroup>
                        </select>
                        <input type="hidden" value='{{$data->area_id}}' id='edit_area_id'>
                      </div>

                      <div class="form-group" style="display:none;" id="select_sub_area1" >
                        <label>Select Sub Area</label>
                          <select data-placeholder="Select" id="select_sub_area" name="sub_area_id"  class="form-control form-control-lg select-search" data-container-css-class="select-lg" data-fouc>
                              <option value=""></option>
                          </select>
                           <input type="hidden" value='{{$data->sub_area_id}}' id='edit_sub_area_id'>
                      </div>
                          <input type="hidden" value='{{$data->user->id}}' name='user_id'>
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

<script type="text/javascript">



      var val=$('#Affiliate_Post_Type').val();
       if(val=='AM')
       {
            $('#select_area1').css("display","block");
            $('#select_sub_area1').css("display","none");
       }
        else
        {
            $('#select_area1').css("display","block");
            $('#select_sub_area1').css("display","block");
        }



        var area= $('#edit_area_id').val();
           var sub_area= $('#edit_sub_area_id').val();
        
        if(area !='')
        {
          var id=area;

          $('#select_sub_area').find('option').not(':first').remove();
            $.ajax({
                url: '{{route('admin.sub_area_list')}}',
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

                            if(sub_area==id){
                                 var option = "<option value='"+id+"' selected='selected'>"+name+"</option>";
                            $("#select_sub_area").append(option);
                          }else
                          {
                               var option = "<option value='"+id+"'>"+name+"</option>";
                            $("#select_sub_area").append(option);
                          }

                         
                        }
                    }

                }
            });
      
          }



  
  $('#Affiliate_Post_Type').change(function(){
        
     var val=$(this).val();
       if(val=='AM')
       {
        $('#select_area1').css("display","block");
      $('#select_sub_area1').css("display","none");
       }
        else
        {
      $('#select_area1').css("display","block");
      $('#select_sub_area1').css("display","block");
        }
     });

    
      $('#select_area').change(function(){
        var id = $(this).val();
        $('#select_sub_area').find('option').not(':first').remove();
        $.ajax({
            url: '{{route('admin.sub_area_list')}}',
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
                        $("#select_sub_area").append(option);
                    }
                }

            }
        });
    });

</script>

@endsection
