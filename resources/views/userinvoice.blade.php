@extends('layouts.backend')

@section('content')

  <div class="container invoice-section">
    <div class="text-center mt-5 mb-4">
    <img src="{{asset('homeassets/images/check green.png')}}" alt="" class="img-fluid" width="100px">
    <div class="invoice-title text-success text-uppercase mt-4">Your order has been placed</div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="invoice-wrapper mb-5">
          <h3 class="invoice-heading mb-4">
            order details
          </h3>
          <ul class="invoice-details">
            <li>
              <span class="detail-left">Customer Name</span>
              <span class="detail-right">{{$order->name}}</span>
            </li>
            
            <li>
              <span class="detail-left">Payment Mode</span>
              <span class="detail-right">{{$order->payment_mode}}</span>
            </li>
            <li>
              <span class="detail-left">Mobile Number</span>
              <span class="detail-right">{{$order->number}}</span>
            </li>
            <li>
              <span class="detail-left">Address</span>
              <span class="detail-right address">{{$order->ConsumerAddress->address}}</span>
            </li>
            @if($order->delivery_instruction)
            <li>
              <span class="detail-left">Any Delivery Instructions</span>
              <span class="detail-right">{{$order->delivery_instruction}}</span>
            </li>
            @endif
            <li>
              <span class="detail-left">Restaurant Name</span>
              <span class="detail-right">{{$order->entitybranch->title}}</span>
            </li>
            <li>
              <span class="detail-left">TRN Type</span>
              <span class="detail-right">Delivery</span>
            </li>
            <li>
              <span class="detail-left">Total Bill</span>
              <span class="detail-right">PKR {{$order->total_amount}}</span>
            </li>
          </ul>
          
        </div>
      </div>
    </div>
  </div>

@endsection
