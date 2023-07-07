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
            <form action="{{route('placeOrder')}}" method="POST">
            {{csrf_field()}}
              <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="first_name" class="form-control" id=""  placeholder="Enter First Name">
              </div>
              <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="last_name" class="form-control" id="" placeholder="Enter Last Name">
              </div>
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" id="" placeholder="Enter Email">
              </div>
              <div class="form-group">
                <label for="">Contact Number</label>
                <input type="tel" name="contact_number" class="form-control" id="" placeholder="Enter Contact Number">
              </div>
              
              <div class="form-group">
                <a href="" class="location" role="button" data-toggle="modal" data-target="#map_currentLocation"><img src="{{asset('homeassets/images/place-24px.png')}}" width="20px"> Click here to select your address in the map</a>
              </div>
              <div class="form-group">
                <label for="">Address</label>
                <input class="form-control" name="address" id="address" type="text" placeholder="Enter Your Address Here" />
              </div>
              <div class="form-group">
                <label for="">Any Delivery Instructions</label>
                <input class="form-control" type="text" name="delivery_instruction" placeholder="Street no, House no" />
              </div>
              <input type="hidden" name="user_lat" value="" class="form-control" placeholder="Latitude" readonly>
               <input type="hidden" name="user_long" value="" class="form-control" placeholder="Longitude" readonly>
            <div class="form-group">
                        <label>Payment Mode</label>
                        <input type="text" name="payment_mode1" value="Cash On Delivery" disabled class="form-control">
                        <input type="hidden" name="payment_mode" value="Cash On Delivery">
                 </div>
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
                  <a href="" class="float-right mr-2" style="opacity:0;"><img src="assets/images/Union 8.png"></a>
                  <div class="row pt-2">
                    <div class="col-lg-8">
                      <h5>{{$item->product}}</h5> 
                      <p>{{$item->addons_name}}
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
                    <span class="right-side">PKR {{$total_amount}}</span>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mt-10">
                    <span class="left-side">Delivery fee</span>
                    <span class="right-side">PKR {{$entity->delivery_charge}}</span>
                  </div>
                   @if($settings && $settings->tax != null)
                  <div class="d-flex align-items-center justify-content-between mt-10">
                    <span class="left-side">Tax</span>
                    <span class="right-side">PKR {{$tax}}</span>
                  </div>
                  <?php $overallTotal = $total_amount + $entity->delivery_charge + $tax;?>
                         @else
                          <?php $overallTotal = $total_amount + $entity->delivery_charge;?>
                         @endif
                </div>
               
                <div class="box-shadow1 mx-1 mt-3 mb-4 p-3">
                  <h3 class="font-size1 font-weight-bold total float-left m-0">Total</h3>
                  <span class="total-price float-right">PKR {{$overallTotal}}</span>
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
//    // Initialize and add the map
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

@endsection
