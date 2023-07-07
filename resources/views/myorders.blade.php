
@extends('layouts.backend')

@section('content')
<div class="container ">
<br>
        <div class="form-group col-md-12">
        <div class="row">
            <div class="form-group col-md-1"></div>
        <div class="form-group col-md-10"> <h2><strong>My Orders Summary</strong></h2>
        <br>
        <h4>Click On Order To View Its Detail</h4>
        </div>
        <div class="form-group col-md-1"></div>

        </div>
        <div class="row">
        <div class="form-group col-md-1"></div>
        <div class="form-group col-md-10">
    <div class="panel-group" id="faqAccordion">
       
        @foreach($orders as $order)
        <div class="panel panel-default ">
            <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#order_{{$order->id}}">
                 <h4 class="panel-title">
                    <a href="#" class="ing">Order # {{$order->id}}</a>
                </h4>
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>Merchant</th>
                    <th>Merchant #</th>
                    <th>Tansaction #</th>
                    <th>Payment Mode</th>
                    <th>Tax</th>
                    <th>Delivery Fee</th>
                    <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>{{$order->entitybranch->title}}</td>
                    <td>{{$order->entitybranch->phone}}</td>
                    <td>{{$order->payment_id}}</td>
                    <td>{{$order->payment_mode}}</td>
                    <td>@if($order->tax == null) PKR 0.00 @else PKR {{$order->tax}} @endif</td>
                    <td>@if($order->entitybranch->delivery_charge == null) PKR 0.00 @else PKR {{$order->entitybranch->delivery_charge}} @endif</td>
                    <td>PKR {{$order->total_amount}}</td>
                    </tr>
                  </tbody>
                </table>
            </div>
            <div id="order_{{$order->id}}" class="panel-collapse collapse" style="height: 0px;">
                <div class="panel-body">
                     <h5><span class="label label-primary">Order Details</span></h5>

                       <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Addons</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($order->orderdetails as $item)
                  <tr>
                    <td>{{$item->product}}</td>
                    <td>
                    @if($item->addon_names != null)
                    @foreach($item->addon_names as $name)
                    {{$name}},
                    @endforeach
                    @else
                    --
                    @endif
                    </td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->amount}}</td>
                   </tr>
                   @endforeach
                  </tbody>
                </table>
                   
                </div>
            </div>
        </div>
        
       @endforeach
     
        
    </div>
    <!--/panel-group-->
      </div>
      <div class="form-group col-md-1"></div>
      </div>
    </div>
</div>

@endsection