@extends('layouts.backend')

@section('content')
<div class="banner">
      <img src="{{asset('homeassets/images/2035.png')}}" class="img-fluid" alt="banner">
    </div>
    <div class="checkout-section pt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-4">
            <div class="h3 text-uppercase">delivery details</div>
             <form action="{{route('placeuserOrder')}}" method="POST">
            {{csrf_field()}}
              <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="first_name" class="form-control" id=""  @if($user->first_name != null) value="{{$user->first_name}}" readonly @endif placeholder="Enter First Name ">
              </div>
              <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="" @if($user->last_name != null) value="{{$user->last_name}}" readonly @endif placeholder="Enter Last Name ">
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email"  class="form-control" id="" @if($user->email != null) value="{{$user->email}}" readonly @endif placeholder="Enter Your Email">
              </div>
               <div class="form-group">
                <label for="">Contact Number</label>
                <input type="tel" name="contact_number" value="{{$user->contact_number}}" class="form-control" id="" placeholder="Enter Contact Number">
              </div>
               @if(!empty($address))
                <div class="form-group" id="select_new">
                  
                  <a class="btn btn-outline-warning" onclick="getOldAddress()" style="cursor:pointer">Select From Old Address</a>
                
                </div>
                <div class="form-group" id="select_old" style="display:none">
                  
                  <a class="btn btn-outline-warning" onclick="getNewAddress()" style="cursor:pointer">Add New Address</a>
                
                </div>
                <div class="form-group" id="old_add" style="display:none">
                
                  <label>Select Your Address</label>
                  <select class="form-control" name="select_address" id="select_address">
                    <option value="">Select an Address</option>
                    @foreach($address as $add)
                    <option value="{{$add->id}}">{{$add->address}}</option>
                    @endforeach
                  </select>
                
                </div>

                @endif
                <div class="form-group" id="new_addres">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control"  placeholder="Enter Your Address " >
                        
                </div>
                <div class="form-group" id="new_loc">
                <a href="" class="location" role="button" data-toggle="modal" data-target="#map_currentLocation"><img src="{{asset('homeassets/images/place-24px.png')}}" width="20px"> Click here to select your address in the map</a>
                 </div>

                    
                                 <input type="hidden" name="user_lat" value="" class="form-control" placeholder="Latitude" readonly>
                              
                             
                                
                                 <input type="hidden" name="user_long" value="" class="form-control" placeholder="Longitude" readonly>
                             
                
              
             
              <div class="form-group">
                <label for="">Any Delivery Instructions</label>
                <input class="form-control" type="text" name="delivery_instruction" placeholder="Street no, House no" />
              </div>
               <div class="form-group">
               <input type="hidden" name="user_id" value="{{$user->id}}">
                        <label>Payment Mode</label>
                        <input type="text" name="payment_mode1" value="Cash On Delivery" disabled class="form-control">
                        <input type="hidden" name="payment_mode" value="Cash On Delivery">
                 </div>
                 <input type="hidden" name="voucher_id" id="voucher_id" value="">
                 <div class="form-group">
                   <button  type="submit" style="cursor:pointer" class="box-shadow1 checkout-bg mx-1 my-3 btn-block pcheck-3 text-white font-size1 font-regular text-uppercase font-weight-bold">Check Out <span class="mr-icon text-white"><i class="fas fa-arrow-right"></i></span></button>
                </div>
            </form>
          </div>
          <div class="col-md-2"></div>
          @if(count($cart) > 0)
          <div class="col-md-4">
            <aside>
              <div class="box-shadow1 p-3">
                <h1 class="font-weight-bold h2-s pb-2 text-center">Your order</h1>
                <?php $total_amount = 0;?>
                @foreach($cart as $item)
                <div class="box-shadow1 mx-1">
                  <a href="" class="float-right mr-2" style="opacity:0;"><img src="{{asset('homeassets/images/Union 8.png')}}"></a>
                  <div class="row pt-2">
                    <div class="col-lg-8">
                      <h5>{{$item->product}}</h5> 
                      <p>
                      @foreach($item->addon_names as $name)
                      {{$name}}, 
                      @endforeach
                      </p>
                    </div>
                    <div class="col-lg-4 px-0 text-right pt-1">
                      <p class="pt-3 font-size">PKR {{$item->total_price}}</p>
                      <div class="btn-group order-btn">
                        
                        <button type="button" class="btn btn-setting" id="order-value" disabled=""><span>Qty </span>{{$item->quantity}}</button>
                       
                      </div>
                    </div>
                  </div>
                </div>
                <?php $total_amount = $total_amount + $item->total_price;?>
                @endforeach
                 @if($settings && $settings->tax != null)
                 <?php $tax = ($total_amount * ($settings->tax / 100)); ?>

                 @endif
               <div class="box-shadow1 fare p-3 mt-3">
                  <div class="d-flex align-items-center justify-content-between">
                    <span class="left-side">Subtotal</span>
                    <span class="right-side" id="sub_total">PKR {{$total_amount}}</span>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-10">
                    <span class="left-side">Delivery fee</span>
                    <span class="right-side" id="delivery_charge">PKR {{$entity->delivery_charge}}</span>
                  </div>
                   @if($settings && $settings->tax != null)
                  <div class="d-flex align-items-center justify-content-between mt-10">
                    <span class="left-side">Tax</span>
                    <span class="right-side" id="tax">PKR {{$tax}}</span>
                  </div>
                  <?php $overallTotal = $total_amount + $entity->delivery_charge + $tax;?>
                         @else
                          <?php $overallTotal = $total_amount + $entity->delivery_charge;?>
                         @endif
                         <div id="discount_type" style="display:none">
                <div class="d-flex align-items-center justify-content-between mt-10" >
                    <span class="left-side">Discount Amount</span>
                    <span class="right-side" id="discount_amount">PKR {{$tax}}</span>
                  </div>
                  </div>
                </div>
                 @if(count($voucher) > 0)
                <div class="vocher" id="voucher">
                  <div class="vocher-title">
                     Vouchers You Have
                  </div>
                  <div class="vocher-tab">
                  @foreach($voucher as $promo)
                    <input type="radio" name="tab" id="tab-{{$promo->id}}" hidden>
                    <label for ="tab-{{$promo->id}}" onclick="applyVoucher({{$promo->id}},'{{$promo->evoucher->discount_type}}',@if($promo->evoucher->discount_type == 'FIXED') {{$promo->evoucher->discount_amount}}  @else {{$promo->evoucher->discount_percentage}} @endif)">
                      <span class="vocher-left">{{$promo->evoucher->name}}</span>
                      <span class="vocher-right">@if($promo->evoucher->discount_type == 'FIXED') PKR {{$promo->evoucher->discount_amount}}  @else {{$promo->evoucher->discount_percentage}} % @endif</span>
                    </label>
                     @endforeach
                  </div>
                </div>
                 @endif
                <div class="box-shadow1 mx-1 mt-3 mb-4 p-3">
                  <h3 class="font-size1 font-weight-bold total float-left m-0">Total</h3>
                  <span class="total-price float-right" id="overall_amount">PKR {{$overallTotal}}</span>
                  <div class="clearfix"></div>
                </div>
                
              </div>
            </aside>
          </div>
          @endif

          <div class="col-md-1"></div>
        </div>
      </div>
    </div>

        <div id="map_currentLocation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog">
              <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Pin Your Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
                 </div>
                 <div class="modal-body">
                    <div id="map_canvas_user" style="width: 570px;height: 400px;"></div>
                    <div id="current">Nothing yet...</div>
                 </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>
              </div>
           </div>
        </div>

      <script>

       function getOldAddress(){

        document.getElementById('old_add').style.display= 'block';
        document.getElementById('select_new').style.display ='none';
        document.getElementById('new_addres').style.display = 'none';
        document.getElementById('new_loc').style.display='none';
        document.getElementById('select_old').style.display = 'block'; 
        document.getElementById('address').value = "";
       

       }
          function getNewAddress(){

        document.getElementById('old_add').style.display= 'none';
        document.getElementById('select_new').style.display ='block';
        document.getElementById('select_old').style.display = 'none';
        document.getElementById('new_addres').style.display = 'block';
        document.getElementById('new_loc').style.display='block';
        document.getElementById('select_address').value = "";

       }

function initMap() {
      
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (p) {
        var LatLng = new google.maps.LatLng(p.coords.latitude, p.coords.longitude);
       
            var mapOptions = {
                center: LatLng,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            
            var map = new google.maps.Map(document.getElementById('map_canvas_user'),mapOptions);
            var myMarker = new google.maps.Marker({
                position: LatLng,
                draggable: true
            });
            google.maps.event.addListener(myMarker, 'dragend', function (evt) {
                document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
                $('input[name=user_lat]').val(evt.latLng.lat());
                $('input[name=user_long]').val(evt.latLng.lng());
                const input = document.querySelector('#longitude')
                input.value = evt.latLng.lat();
                const event = new Event('input', {
                    cancelable: true,
                    bubbles: true
                })
                input.dispatchEvent(event);

                const input1 = document.querySelector('#latitude')
                input1.value = evt.latLng.lat();
                const event1 = new Event('input', {
                    cancelable: true,
                    bubbles: true
                })
                input1.dispatchEvent(event1);
                console.log(evt);
            });

            google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
                document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
            });

            map.setCenter(myMarker.position);
            myMarker.setMap(map);

            });
        }
        else
        {
            alert('Geo Location feature is not supported in this browser.');
        }

   }
</script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKuPKvQgXplnAGAblaK7mOT5HoQKAfqaU&callback=initMap">
    </script>


        <script type="text/javascript">


                function applyVoucher(id,type,amount){
                   
                              // alert(id+','+type+','+amount);
                              document.getElementById('voucher_id').value = id;
                              document.getElementById('voucher').style.display = 'none';

                              if(type == 'FIXED'){

                                    var sub_total = document.getElementById('sub_total').innerHTML;
                                    sub_total =sub_total.split(" ");
                                    sub_total =sub_total[1];
                                    //alert(sub_total);
                                    var newtotal = 0;
                                    var overallTotal = document.getElementById('overall_amount').innerHTML;
                                    overallTotal =overallTotal.split(" ");
                                    overallTotal =overallTotal[1];
                                   // alert(overallTotal);
                                    var newOverallTotal = 0;
                                    newtotal = Number(sub_total)  - Number(amount);
                                   // alert(newtotal);
                                    // var delivery_charge = document.getElementById('delivery_charge').innerHTML;
                                    // delivery_charge = delivery_charge.split(" ");
                                    // delivery_charge =delivery_charge[1];
                                    // var tax = document.getElementById('tax').innerHTML;
                                    // tax = tax.split(" ");
                                    // tax =tax[1];
                                    newOverallTotal = Number(overallTotal) - Number(amount);

                                    document.getElementById('sub_total').innerHTML = 'PKR '+newtotal.toFixed(2);
                                    document.getElementById('overall_amount').innerHTML ='PKR '+ newOverallTotal;
                                    document.getElementById('discount_amount').innerHTML ='PKR '+ amount;
                                    document.getElementById('discount_type').style.display = 'block';


                              }
                              else
                              {

                                    var amount_per = Number(amount) / 100 ;
                                    var sub_total = document.getElementById('sub_total').innerHTML;
                                    sub_total =sub_total.split(" ");
                                    sub_total =sub_total[1];
                                   // alert(sub_total);
                                    var newtotal = 0;
                                    var overallTotal = document.getElementById('overall_amount').innerHTML;
                                    overallTotal =overallTotal.split(" ");
                                    overallTotal =overallTotal[1];
                                    var newOverallTotal = 0;
                                    amount  = Number(sub_total) * Number(amount_per);
                                    newtotal = Number(sub_total)  - Number(amount);
                                   // alert(amount+ "," + newtotal);
                                    var delivery_charge = document.getElementById('delivery_charge').innerHTML;
                                    delivery_charge = delivery_charge.split(" ");
                                    delivery_charge =delivery_charge[1];
                                    var tax = document.getElementById('tax').innerHTML;
                                    tax = tax.split(" ");
                                    tax =tax[1];
                                    //alert(delivery_charge);
                                    newOverallTotal = Number(newtotal) +  Number(delivery_charge) + Number(tax);
                                   // alert(newOverallTotal);
                                    document.getElementById('sub_total').innerHTML ='PKR '+ newtotal.toFixed(2);
                                    document.getElementById('overall_amount').innerHTML ='PKR '+ newOverallTotal.toFixed(2);
                                    document.getElementById('discount_amount').innerHTML ='PKR '+ amount.toFixed(2);
                                    document.getElementById('discount_type').style.display = 'block';

                              }
                           }
                
                
        </script>



@endsection
