@extends('Admin::layouts.backend')

@section('content')
<!-- Page header -->
   <div class="content">
      
<div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Orders</h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
          </div>
        </div>
      </div>
      <!-- /page header -->

  <!-- Scrollable datatable -->
        <div class="card">

          <table class="table datatable-scroll-y" width="100%">
            <thead>
              <tr>
                <th>Ref#</th>
                <th>Entity Name</th>
                <th>Name</th>
                <th>Items</th>
                <th>Payment Type</th>
                <th>Total</th>
                <th>Date</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="tabledata">
              @foreach($lists as $info)
               <tr>
                  <td>{{$info->id}}</td>
                  
                  @if($info->entitybranch)
                    <td>{{$info->entitybranch->title}}</td>
                  @endif

                  <td>{{$info->name}}</td>

                  <td>
                    @foreach($info->orderdetails as $products)
                      @foreach($products->products_name as $name)
                        {{$name->name}} - 
                      @endforeach
                    @endforeach
                  </td>

                  <td>{{$info->payment_mode}}</td>
                  <td>{{$info->total_amount}}</td>
                  <td>{{$info->created_at}}</td>

                  @if($info->orderstatus)
                  
                    @if ($info->orderstatus->id == 0)
                      <td><span class="badge badge-danger">{{$info->orderstatus->name}}</span></td>
                    @endif
                    @if ($info->orderstatus->id != 0)
                      <td><span class="badge badge-success">{{$info->orderstatus->name}}</span></td>
                    @endif

                  @endif
                  <td class="text-center">
                  <div class="list-icons">
                    <div class="dropdown">
                      <button type="button" id="edit_status" value="{{$info->id}}" class="btn btn-primary"><i class="icon-pencil3"></i></button>
                      |
                      <button type="button" id="view" value="{{$info->id}}" class="btn btn-light"><i class="icon-eye2"></i></button>
                    </div>
                  </div>
                </td>

                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /scrollable datatable -->

        <!-- Horizontal form modal -->
        <div id="modal_form_horizontal" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header" id="header">
                
              </div>

              <form action="#" class="form-horizontal">
                <div class="modal-body">
                  <div class="alert alert-info alert-dismissible alert-styled-left border-top-0 border-bottom-0 border-right-0" id="message_div" style="display:none;">
                    <span class="font-weight-semibold" id="message"></span>
                    <button type="button" class="close" data-dismiss="alert">×</button>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-1"></div>
                    <div class="form-group col-md-10">
                      <div class="panel-group" id="faqAccordion">
                   
                        
                      </div>
                <!--/panel-group-->
                      </div>
                    <div class="form-group col-md-1"></div>
                  </div>

                <div class="modal-footer" id="footer">
                  
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /horizontal form modal -->

        <!-- Horizontal form modal -->
        <!-- <div id="modal_form_horizontal" class="modal fade custom_test" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Order Status</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                <div class="modal-body">
                  <div class="alert alert-info alert-dismissible alert-styled-left border-top-0 border-bottom-0 border-right-0" id="message_div" style="display:none;">
                    <span class="font-weight-semibold" id="message"></span>
                    <button type="button" class="close" data-dismiss="alert">×</button>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-sm-3">Status</label>
                    <div class="col-sm-9" id="show_status_details">
                      

                    </div>
                  </div>

                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal" id="status_modal">Close</button>
                  <button type="submit" id="submit_status" class="btn bg-primary">Submit form</button>
                </div>
            </div>
          </div>
        </div> -->
        <!-- /horizontal form modal -->


      </div>
    </div>

<script>

  $(document).ready(function(){

            //Entity Details Modal
            function fetch_entity_details(query)
            {
                $.ajax({
                    url:"{{ route('order_details.action') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                
                    success:function(data)
                    {
                      //$('#faqAccordion').html("");
                      $('#faqAccordion').html(data.body_data);
                      $('#header').html(data.header);
                      $('#footer').html(data.footer);
                      $('#modal_form_horizontal').modal("show");
                    }
                })
            }

            $(document).on('click','#view',function(){
                var query = $(this).val();
                fetch_entity_details(query);
             });



            //Status Modal
            function fetch_status_details(query)
            {
                $.ajax({
                    url:"{{ route('status_details.action') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                
                    success:function(data)
                    {
                      //$('#faqAccordion').html("");
                      $('#faqAccordion').html(data.body_data);
                      $('#header').html(data.header);
                      $('#footer').html(data.footer);
                      $('#modal_form_horizontal').modal("show");
                    }
                })
            }

            $(document).on('click','#edit_status',function(){
                var query = $(this).val();
                fetch_status_details(query);
             });

            
            //Status Store
            $(document).on('click','#submit_status',function(){
                var status_id = $(update_status).val();
                var order_id = $("#update_status").attr("name");
                fetch_store_status(status_id,order_id);
             });
            

            function fetch_store_status(status_id,order_id)
            {
                $.ajax({
                    url:"{{ route('store_status.action') }}",
                    method:'GET',
                    data:{status_id:status_id,order_id:order_id},
                    dataType:'json',
                
                    success:function(data)
                    {
                      $('#tabledata').html(data.table_data);
                      $('#message_div').css("display","block");
                      $('#message').html(data.statusUpdatemessage);
                    }
                })
            }

            
  });

            function notification(data){

              Push.create("Hello Admin! New Order Received...Order# is", {
                  body: JSON.stringify(data.orderId),
                  icon: '/homeassets/images/ordericon.png',
                  timeout: 4000,
                  onClick: function () {
                      window.focus();
                      this.close();
                  }
              });
            }

</script>

<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('198688574bd55a69f731', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      notification(data);
      //alert(JSON.stringify(data));
    });

</script>



@endsection
