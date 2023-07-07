@extends('Admin::layouts.backend')

@section('content')
<!-- Page header -->
   <div class="content">
      
<div class="content-wrapper">
      <div class="page-header border-bottom-0">
        <div class="page-header-content header-elements-md-inline">
          <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Customers</h4>
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
                <th>Customer#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact#</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody id="tabledata">
              @foreach($lists as $info)
               <tr>
                  <td>{{$info->id}}</td>
                  <td>{{$info->first_name}}</td>
                  <td>{{$info->last_name}}</td>
                  <td>{{$info->username}}</td>
                  <td>{{$info->email}}</td>
                  <td>{{$info->contact_number}}</td>

                  <td class="text-center">
                  <div class="list-icons">
                    <div class="dropdown">
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
              <div class="modal-header">
                <h5 class="modal-title">Click On Order To View Its Detail</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <form action="#" class="form-horizontal">
                <div class="modal-body">
                  <div class="row">
                    <div class="form-group col-md-1"></div>
                    <div class="form-group col-md-10">
                      <div class="panel-group" id="faqAccordion">
                   
                        
                      </div>
                <!--/panel-group-->
                      </div>
                    <div class="form-group col-md-1"></div>
                  </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /horizontal form modal -->


      </div>
    </div>

<script>

  $(document).ready(function(){

            //Customer Orders Detail Modal
            function fetch_customer_orders_details(query)
            {
                $.ajax({
                    url:"{{ route('customer_order_details.action') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                
                    success:function(data)
                    {
                      $('#faqAccordion').html(data);
                      $('#modal_form_horizontal').modal("show");
                    }
                })
            }

            $(document).on('click','#view',function(){
                var query = $(this).val();
                fetch_customer_orders_details(query);
             });

  });


</script>

@endsection
