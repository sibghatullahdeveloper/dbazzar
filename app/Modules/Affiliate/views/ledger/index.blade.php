@extends('Affiliate::layouts.backend')

@section('content')
    <!-- Page header -->
    <div class="content">

        <div class="content-wrapper">
            <div class="page-header border-bottom-0">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> - Ledger</h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body" width="100%">
                  
              
                </div>


                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
            @endif

            <div class="form-group">
                <label>Select Date:</label>
                <div class="input-group" id="submit_date">
                    <span class="input-group-prepend">
                        <span class="input-group-text"><i class="icon-calendar22"></i></span>
                    </span>
                    <input type="text" class="form-control daterange-single" id="datepicker">
                </div>
            </div>

            <!-- /page header -->
            <!-- Scrollable datatable -->

            <!-- /scrollable datatable -->
            <table class="table datatable-pagination">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Transaction#</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody id="show_ledger_details">
                    
                    @foreach($list as $info)
                        <tr>
                            <td>{{$info->id}}</td>
                            <td>{{$info->transaction_no}}</td>
                            <td>{{$info->type}}</td>
                            <td>{{$info->amount}}</td>
                            <td>{{$info->created_at}}</td>
                        <tr>
                    @endforeach

                </tbody>
                <tfoot id="show_total">
                    <tr>
                        <th>Total Amount</th>
                        <td id="total_amount">{{$totalcredit}}</td>
                    </tr>
                </tfoot>
            </table>
            
            </div>
        </div>
    </div>

<script>
    
    $(document).ready(function(){

            //Status Store
            $(document).on('change','#submit_date',function(){

                var newdate = new Date();
                var date = $(datepicker).val();
                
                dteSplit = date.split("/");
                var month = dteSplit[0];
                var day = dteSplit[1];
                var year = dteSplit[2];

                newdate = year+"-"+month+"-"+day;
                fetch_ledger_details(date);
             });
            

            function fetch_ledger_details(date)
            {
                $.ajax({
                    url:"{{ route('ledger_details.action') }}",
                    method:'GET',
                    data:{date:date},
                    dataType:'json',
                
                    success:function(data)
                    {
                        $('#show_ledger_details').html(data.table_data);
                        $('#total_amount').text(data.total_amount);                       
                    }
                })
            }
    });     

</script>

@endsection

