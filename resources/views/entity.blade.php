
@extends('layouts.backend')

@section('content')

    <div class="img">
      <img src="{{asset('images/entitybranch/'.$header)}}" class="hero-type-img" width="100%" />
    </div>
    <div class="row m-0">
      <div class="col-lg-2"></div>
      <div class="col-lg-8 p-4 col-md-12 col-sm-12 col-12 border-cover">
        <div class="row d-flex category">
          <div
            class="col-lg-9 order-sm-2 order-2 order-md-1 col-md-9 col-sm-9 col-12"
            >
            <div class="p-3">
              <h2>{{$entity->title}}</h2>
              <div class="btn-group btn-group-sm">
              <?php
              $a = 0;

              ?>
              @foreach($entity->tags_name as $tag)
              <?php $a ++; ?>
                @if($a == 1 || $a == 5 || $a == 9 || $a == 13)
                <span class="badge px-3 mr-2 py-2 badge-primary">#{{$tag['name']}}</span>
                @elseif($a == 2 || $a == 6 || $a == 10 || $a == 14)
                <span class="badge px-3 mr-2 py-2 badge-secondary">#{{$tag['name']}}</span>
                @elseif($a == 3 || $a == 7 || $a == 11 || $a == 15)
                <span class="badge px-3 mr-2 py-2 badge-success">#{{$tag['name']}}</span>
                @elseif($a == 4 || $a == 8 || $a == 12 || $a == 16)
                <span class="badge px-3 mr-2 py-2 badge-danger">#{{$tag['name']}}</span>
                @endif
                @endforeach
              </div>
              <p class="pt-3 cover-img mb-5">
                {{$entity->about}}
              </p>
            </div>
          </div>
          <div
            class="col-lg-3 order-sm-1 order-md-2 order-1 col-md-3 col-sm-3 col-12"
            >
            <span class=""
              ><img
              src="{{asset('images/entitybranch/'.$header)}}"
              width="70%"
              class="border-img"
              /></span>
          </div>
        </div>
        <div class="rating">
          <h3 class="px-3">
            <i class="fas fa-star"></i> <span>4.2</span
              ><span class="review"> 3255 Reviews</span>
            <span class="time text-center">Close 12:00 PM</span>
          </h3>
        </div>
      </div>
      <div class="col-lg-2"></div>
    </div>
    @if($settings != null)
    @if($settings->tax != null)
<input type="hidden" name="tax" id="tax" value="{{$settings->tax}}">
@endif
@if($settings->tax != null)
<input type="hidden" name="commission" id="commission" value="{{$settings->commission}}">
@endif
@if($settings->order_type != null)
<input type="hidden" name="order_type" id="order_type" value="{{$settings->order_type}}">
@endif
@if($settings->minimum_purchase != null)
<input type="hidden" name="minimum_purchase" id="minimum_purchase" value="{{$settings->minimum_purchase}}">
@endif
@if($settings->packaging_charge != null)
<input type="hidden" name="packaging_charge" id="packaging_charge" value="{{$settings->packaging_charge}}">
@endif
@if($settings->delivery_time != null)
<input type="hidden" name="delivery_time" id="delivery_time" value="{{$settings->delivery_time}}">
@endif
@endif
<input type="hidden" name="delivery_charge" id="delivery_charge" value="{{$entity->delivery_charge}}">

    <div class="box-shadow headertab" id="myHeader">
      <div class="container mt-negative wrapper">
        <!-- Nav pills -->
        <ul class="nav tab-nav text-center nav-pills tab-container" role="tablist">
           @foreach($productCat as $cat)
          <li class="nav-item">
            <a class="nav-link" href="#menu_{{$cat->id}}"
              >{{$cat->name}}</a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <!-- Tab panes -->
    <div class="container">
      <div class="row">
        <div class="col-lg-7 col-xl-7">
          <div class="tab-content tabSidenav">

             @foreach($productCat as $cat)
            <div id="menu_{{$cat->id}}" class="container tab-panel">
            <h5 class="text-center promotion pt-3">{{$cat->name}}</h5>
              @foreach($products as $prod)

              @if($prod->p_cat_id == $cat->id)
              <div class="row bor-color card-tab py-4 px-2 my-4">
                <div
                  class="col-lg-5 col-xl-5 pr-0 pt-1 col-md-12 col-sm-6 col-12"
                  >
                  @if($prod->image != "NULL")
                  <img
                    src="{{asset('images/foodItems_images/'.$prod->image)}}"
                    width="100%"
                    class="img-style"
                    />
                     @endif
                </div>
                <div class="col-lg-7 col-xl-7 col-md-12 col-sm-12 col-12">
                  <h5 class="font-weight-bold media-p">{{$prod->name}}</h5>
                  <p class="pc position-relative">
                    {{$prod->description}}
                  </p>
                  <p class="btn-p mb-0">
                    PKR {{$prod->display_price}}
                    <button class="float-right btn-add" data-toggle="modal" data-target="#exampleModal_{{$prod->id}}">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        height="24"
                        viewBox="0 0 24 24"
                        width="24"
                        >
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                        <path d="M0 0h24v24H0z" fill="none" />
                      </svg>
                    </button>
                  </p>
                </div>
              </div>

              @endif
              @endforeach

            </div>

            @endforeach
            <!--end categories -->
          </div>
        </div>
        <div class="col-lg-4 ml-auto py-5">
          <aside>
            <div class="box-shadow1 sidenav-fix p-3">
              <h1 class="font-weight-bold h2-s pb-2 text-center">Your order<br> {{$entity->title}}</h1><br>
              @if($settings != null && $settings->delivery_time != null)
              <h2 class="h2-s text-center">Delivery : {{$settings->delivery_time}} min
              @endif
               <h2 class="h2-s text-center">You haven’t added anything to your cart yet! Start adding your favourite dishes</h2><br>

                <div id="cartitem">

                  </div>
              
              <div class="box-shadow1 mx-1 mt-3 mb-4">

                <h3 class="p-3 font-size1 font-regular">Subtotal<span class="mr" id="sub_total">PKR 0.00</span></h3>
                <h3 class="p-3 font-size1 font-regular">Delivery fee<span class="mr" id="delivery_fee">PKR 0.00</span></h3>
             @if($settings != null && $settings->minimum_purchase != null)
                 <h3 class="p-3 font-size1 font-regular" id="min_purchase" style="display:none;">Minimum Purchase<span class="mr">PKR {{$settings->minimum_purchase}}</span></h3>
                <h3 class="p-3 font-size1 font-regular" id="min_difference" style="display:none">Diffrence To Min<span class="mr" id="diffrence_min">PKR 0.00</span></h3>
              @endif
             @if($settings != null && $settings->tax != null)
                 <h3 class="p-3 font-size1 font-regular" id="tax_per" style="display:none;">Tax Percentage<span class="mr">PKR {{$settings->tax}} %</span></h3>
                <h3 class="p-3 font-size1 font-regular" id="tax_val" style="display:none">Tax Value<span class="mr" id="tax_value">PKR 0.00</span></h3>
            
                @endif
                <h3 class="p-3 font-size1 font-regular">Total<span class="mr" id="overall_amount">PKR 0.00</span></h3>


              </div>
               <button  onclick="window.location='{{route('createCheckout')}}'" disabled id="checkout" style="cursor:pointer" class="box-shadow1 checkout-bg mx-1 my-3 btn-block pcheck-3 text-white font-size1 font-regular text-uppercase font-weight-bold">Check Out <span class="mr-icon text-white"><i class="fas fa-arrow-right"></i></span></button>
              <!-- <button class="box-shadow1 checkout-bg mx-1 my-3">
                <h3 class="pcheck-3 text-white font-size1 font-regular text-uppercase">Check Out<span class="mr-icon text-white"><i class="fas fa-arrow-right"></i></span>
                </h3>
              </button> -->
            </div>
          </aside>
        </div>

      </div>
    </div>
<input type="hidden" name="cross" id="cross" value="{{asset('homeassets/images/Union 8.png')}}">
@foreach($products as $prod)
    <div   class="modal fade" id="exampleModal_{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form  id="MenuItems_{{$prod->id}}" name="MenuItems_{{$prod->id}}" action="/">
        {{ csrf_field() }}
      <div class="modal-dialog" role="document">
        <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModal_{{$prod->id}}">{{$prod->name}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <img src="{{asset('images/foodItems_images/'.$prod->image)}}" class="img-fluid" alt="">
          <div class="modal-body">
             <input type="hidden" name="branch_id" value="{{$entity->id}}">
            <div class="row mb-5">
              <div class="col-md-8">
                <h4 class="bucket">{{$prod->name}}</h4>
                <div class="buket-dec">
                  {{$prod->description}}
                </div>
              </div>
              <div class="col-md-4 text-right">
                <span class="bucket-price" id="{{$prod->id}}_base_price">PKR {{$prod->price}}</span>
                <input type="hidden" id="{{$prod->id}}_total_price" name="{{$prod->id}}_total_price" value="{{$prod->price}}">
                 <input type="hidden" name="prod_id" value="{{$prod->id}}">
              </div>
            </div>
           <!--  <span class="require-text float-right">1 required</span> -->
            
           <div class="clearfix"></div>
              
             @if($prod->addonCatogories)
              @foreach($prod->addonCatogories as $categories)


            <div class="box-shadow1 p-3 mt-5">

              <div class="d-flex justify-content-between align-items-center">
                <span class="box-title text-uppercase">{{$categories->name}}</span>
                <span class="require-text box-required">@if($categories->selection_type == "SINGLE")Select 1 @else Select {{$categories->min_selection}} up to {{$categories->max_selection}} @endif</span>
              </div>

               @if($categories->addons)

                   <?php $name_r = explode(' ',$categories->name);  $name_c = count($name_r); $name_r = $name_r[$name_c - 1]?>
                  <input type="hidden" id="{{$prod->id}}_radio_cat_<?php echo $name_r; ?>_{{$categories->id}}" name="{{$prod->id}}_radio_cat_<?php echo $name_r; ?>_{{$categories->id}}" value=" ">
              <input type="hidden" id="{{$prod->id}}_radio_cat_<?php echo $name_r; ?>_{{$categories->id}}_price" name="{{$prod->id}}_radio_cat_<?php echo $name_r; ?>_{{$categories->id}}_price" value=" ">
             
              @foreach($categories->addons as $addons)
                  @if($categories->selection_type == "SINGLE")
              <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="box-left d-flex align-items-center">
                 <label class="containerradio">{{$addons->name}}
                   <?php $name_r = explode(' ',$categories->name);  $name_c = count($name_r); $name_r = $name_r[$name_c - 1]?>
                       <input type="radio"  id="cat_<?php echo $name_r; ?>" name="cat_<?php echo $name_r; ?>" onClick="SingleSelect({{$addons->price}},{{$categories->id}},{{$addons->id}},{{$prod->id}},'{{$categories->name}}')">
                       
                       <span class="checkmarkradio"></span>
                   </label>
                  
                </div>
                <span class="box-right">+ PKR {{$addons->price}}</span>
              </div>
             @else
             
              <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="box-left d-flex align-items-center">
                  <label class="containercheckbox">{{$addons->name}}
                         <?php $name_r = explode(' ',$addons->name);  $name_c = count($name_r); $name_r = $name_r[$name_c - 1]?>
                           <input type="checkbox"  id="add_<?php echo $name_r;?>" onchange="MultiSelect({{$addons->price}},{{$categories->id}}, {{$addons->id}},{{$prod->id}},'{{$addons->name}}')">
                            
                           <span class="checkmarkbox"></span>
                       </label>
                        <input type="hidden" name="{{$prod->id}}_check_add_<?php echo $name_r;?>_{{$addons->id}}" id="{{$prod->id}}_check_add_<?php echo $name_r;?>_{{$addons->id}}" value="">
                </div>
                <span class="box-right">+ PKR {{$addons->price}}</span>
                 
              </div>
             
               @endif

                @endforeach
                    @endif


            </div>
            <div class="clearfix"></div>
              
            <span class="require-text float-right">@if($categories->required > 0) {{$categories->required}} REQUIRED @endif</span>
          
            @endforeach
            @endif

            <div class="box-shadow1 p-3 mt-5">
              <span class="box-title text-uppercase mb-2 d-block">Any Special instructions</span>
              <textarea  id="{{$prod->id}}_comment" name="{{$prod->id}}_comment" cols="30" rows="5" class="form-control" placeholder="eg.no mayo,onion">
              </textarea>
            </div>
          </div>
          <input type="hidden" name="{{$prod->id}}_quantity" id="{{$prod->id}}_quantity" value="1">
          <div class="modal-footer border-0 px-5 pb-5">
            <a  onclick="submitform({{$prod->id}})" class="btn btn-primary btn-block text-left" data-dismiss="modal">
              <strong id="{{$prod->id}}_item_total">PKR {{$prod->price}}</strong>
              <i class="fas fa-arrow-right float-right mt-1" aria-hidden="true"></i>
              <div class="clearfix"></div>
            </a>
          </div>
        </div>
      </div>
      </form>
    </div>

    @endforeach

    @yield('js_after')

<script>
  
function SingleSelect(price,cat,addon,prod_id,name){
      //alert("asdasda");
     // alert(price+ ","+cat+","+addon+","+name+","+prod_id); 
      var stingtostore = cat+"_"+addon;
      var res = name.split(" ");
      var new_id = res[res.length - 1];

      document.getElementById(prod_id+"_radio_cat_"+new_id+"_"+cat).value = addon;

      var prod_price ="";
       if(document.getElementById(prod_id+"_radio_cat_"+new_id+"_"+cat).value != '')
      {
        var old_price = document.getElementById(prod_id+"_radio_cat_"+new_id+"_"+cat+"_price").value;
        prod_price = document.getElementById(prod_id+'_total_price').value;
        prod_price = Number(prod_price) - Number(old_price);
      }
      else
      {

       prod_price = document.getElementById(prod_id+'_total_price').value;
      }

      var total_price = Number(price) + Number(prod_price);
      //alert(total_price);
      document.getElementById(prod_id+"_radio_cat_"+new_id+"_"+cat+"_price").value =price;
      document.getElementById(prod_id+'_base_price').innerHTML ="PKR "+ total_price.toFixed(2);
        document.getElementById(prod_id+'_total_price').value = total_price.toFixed(2);
        document.getElementById(prod_id+ '_item_total').innerHTML = "PKR "+total_price.toFixed(2);
}


function MultiSelect(price,cat,addon,prod_id,name){
        var stingtostore = cat+"_"+addon;
        var res = name.split(" ");
        var new_id = res[res.length - 1];
        //alert(prod_id+"_check_add_"+new_id+"_"+addon);
        document.getElementById(prod_id+"_check_add_"+new_id+"_"+addon).value = addon;
        var prod_price = document.getElementById(prod_id+'_total_price').value;
        var total_price = Number(price) + Number(prod_price);

        document.getElementById(prod_id+'_base_price').innerHTML ="PKR "+ total_price.toFixed(2);
        document.getElementById(prod_id+'_total_price').value = total_price.toFixed(2);
        document.getElementById(prod_id+ '_item_total').innerHTML = "PKR "+total_price.toFixed(2);

}

function increase_quantity(prod_id){

      var total = document.getElementById(prod_id+'_total_price').value;
    //  alert(total);
      if(Number(total) > 0){
       var qty = document.getElementById(prod_id+'_quantity').value;
       var price = document.getElementById(prod_id+'_total_price').value;
       var single_price = Number(price) / Number(qty);
        qty = Number(qty) + 1;
       var new_total = Number(single_price) * Number(qty);
        document.getElementById(prod_id+'_quantity').value = qty;
        document.getElementById(prod_id+'_qty_value').innerHTML =qty;
        document.getElementById(prod_id+'_base_price').innerHTML = new_total;
        document.getElementById(prod_id+'_total_price').value = new_total;
        document.getElementById(prod_id+ '_item_total').innerHTML = "PKR "+new_total;        
      }
}
function decrease_quantity(prod_id){


 var total = document.getElementById(prod_id+'_total_price').value;
      if(Number(total) > 0){
       var qty = document.getElementById(prod_id+'_quantity').value;
      
       var price = document.getElementById(prod_id+'_total_price').value;
        var single_price = Number(price) / Number(qty);
         qty = Number(qty) - 1;
         if(qty > 0){
          var new_total =  Number(price) - Number(single_price);
        document.getElementById(prod_id+'_quantity').value = qty;
        document.getElementById(prod_id+'_qty_value').innerHTML =qty;
        document.getElementById(prod_id+'_base_price').innerHTML = new_total;
        document.getElementById(prod_id+'_total_price').value = new_total;
        document.getElementById(prod_id+ '_item_total').innerHTML = "PKR "+new_total; 
         }
         
         
      }

}
function DcreaseQuantityByOne(id){
//alert(item_id);
  var price = document.getElementById("total_"+id).innerHTML;
  price = price.split(" ");
  price =price[1];
  if(Number(price) > 0){
    var Qty = document.getElementById(id+"_quantityvalue").innerHTML;
  var single_price= Number(price) / Number(Qty);
  Qty = Number(Qty) - 1;

  var new_price = Number(price) - Number(single_price);
    document.getElementById("total_"+id).innerHTML ='PKR '+ new_price.toFixed(2);
    var sub_total =document.getElementById("sub_total").innerHTML;
    sub_total =sub_total.split(" ");
    sub_total =sub_total[1];
    sub_total  = Number(sub_total) - Number(single_price);
    document.getElementById("sub_total").innerHTML ='PKR '+sub_total.toFixed(2);
    

    document.getElementById(id+ "_quantityvalue").innerHTML = Qty;
    var total_amount = document.getElementById("overall_amount").innerHTML;


  var diffrence_min = document.getElementById('diffrence_min').innerHTML;
      diffrence_min =diffrence_min.split(" ");
      diffrence_min = diffrence_min[1];
    var minimum_purchase = document.getElementById('minimum_purchase').value;

    if(diffrence_min > 0 && minimum_purchase !=null && (minimum_purchase - sub_total) > 0){
      document.getElementById('diffrence_min').innerHTML ='PKR '+ Number(minimum_purchase - sub_total);
       document.getElementById('min_difference').style.display = 'block';
       document.getElementById('min_purchase').style.display = 'block';
       document.getElementById('checkout').disabled =true;
    }
    else
    {
       document.getElementById('min_difference').style.display = 'none';
       document.getElementById('min_purchase').style.display = 'none';
       document.getElementById('checkout').disabled =false;
    }
    var tax = document.getElementById('tax').value;
     var tax_val = 0;
     var delivery_fee = 0;
                           if(Number(tax) > 0 && tax !=null)
                          {
                            
                            
                           
                            tax_val = Number((Number(tax) / 100) * Number(sub_total));
                              document.getElementById('tax_val').style.display = 'block';
                            document.getElementById('tax_value').innerHTML ='PKR '+ tax_val.toFixed(2);
                          

                          }

    var delivery_charge = document.getElementById('delivery_charge').value;
    if(delivery_charge != null && delivery_charge > 0)
    {
      delivery_fee =delivery_charge;
    }
    if(sub_total == 0)
    {
      delivery_fee = 0;
      document.getElementById('tax_per').style.display = 'none';
      document.getElementById('tax_val').style.display = 'none';

    }
     total_amount =  Number(sub_total) + Number(tax_val) + Number(delivery_fee);
    document.getElementById("overall_amount").innerHTML ='PKR '+ total_amount.toFixed(2);


  if(Qty > 0){
    

     $.ajax({
               url: '{{route('dcreaseQuantity')}}',
               type: 'post',
               data:{"_token": "{{ csrf_token() }}",qty :Qty,price:new_price, id:id},
               dataType: 'json',
               success: function(response){
                   console.log(response,"result");
                 
               }
           });

  }
  else if(Qty == 0)
      {
              $.ajax({
               url: '{{route('removeItem')}}',
               type: 'post',
               data:{"_token": "{{ csrf_token() }}", id:id},
               dataType: 'json',
               success: function(response){
                   console.log(response,"result");
                 //location.reload(true);
                 $('#item_'+id).remove();

                 document.getElementById('delivery_fee').innerHTML = 'PKR 0.00';
                 document.getElementById('checkout').disabled = true;
               }
           });
      }
  }
}

function IncreaseQuantityByOne(id){

var price = document.getElementById("total_"+id).innerHTML;
alert(price);
price = price.split(" ");
price = price[1];
//alert(price+","+Qty);
  if(Number(price) > 0){
    var Qty = document.getElementById(id+"_quantityvalue").innerHTML;
    alert(Qty);
    var single_price= Number(price) / Number(Qty);
    Qty =  Number(Qty) + 1;
    var new_price = Number(price) + Number(single_price);
   // alert(price+','+Qty+','+single_price+','+new_price);
    document.getElementById("total_"+id).innerHTML ='PKR '+ new_price.toFixed(2);
     var sub_total =document.getElementById("sub_total").innerHTML;
     sub_total = sub_total.split(" ");
     sub_total = sub_total[1];
    sub_total  = Number(sub_total) + Number(single_price);
    document.getElementById("sub_total").innerHTML ='PKR '+sub_total.toFixed(2);
    
    document.getElementById(id+ "_quantityvalue").innerHTML =Qty;
    var total_amount = document.getElementById("overall_amount").innerHTML;
    total_amount = total_amount.split(" ");
    total_amount =total_amount[1];
     var diffrence_min = document.getElementById('diffrence_min').innerHTML;
     diffrence_min = diffrence_min.split(" ");
     diffrence_min = diffrence_min[1];
    var minimum_purchase = document.getElementById('minimum_purchase').value;

    if(diffrence_min > 0 && minimum_purchase !=null && (minimum_purchase - sub_total) > 0){
      document.getElementById('diffrence_min').innerHTML ='PKR '+ Number(minimum_purchase - sub_total);

    }
    else
    {
       document.getElementById('min_difference').style.display = 'none';
       document.getElementById('min_purchase').style.display = 'none';
       document.getElementById('checkout').disabled =false;
    }
    var tax = document.getElementById('tax').value;
     var tax_val = 0;
     var delivery_fee = 0;
                           if(Number(tax) > 0 && tax !=null)
                          {
                            
                            
                           
                            tax_val = Number((Number(tax) / 100) * Number(sub_total));
                              document.getElementById('tax_val').style.display = 'block';
                            document.getElementById('tax_value').innerHTML ='PKR '+ tax_val.toFixed(2);
                          

                          }

    var delivery_charge = document.getElementById('delivery_charge').value;
    if(delivery_charge != null && delivery_charge > 0)
    {
      delivery_fee =delivery_charge;
    }

     total_amount = Number(sub_total) + Number(tax_val) + Number(delivery_fee);
    document.getElementById("overall_amount").innerHTML ='PKR '+ total_amount.toFixed(2);

    $.ajax({
               url: '{{route('increaseQuantity')}}',
               type: 'post',
               data:{"_token": "{{ csrf_token() }}",qty :Qty,price:new_price, id:id},
               dataType: 'json',
               success: function(response){
                   console.log(response,"result");
                  
               }
           });
  }
}
function removeItem(id){

  
}
</script>
<script type="text/javascript">
 
   function submitform(prod_id){

          $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   });
   

    var form = $('#MenuItems_'+prod_id).serialize();
    console.log(form);
    var cross = document.getElementById('cross').value;
      $.ajax({
               url: '{{route('addItemTocart')}}',
               type: 'post',
               data:form,
               dataType: 'json',
               success: function(response){
                   console.log(response,"result");
                   $('#exampleModalLong_'+prod_id).modal('hide');
                   // console.log(response.length);
                    if(response){
                     // alert(response.product);
                        $('#cartitem').append('<div class="box-shadow1 mx-1" id="item_'+response.id+'"><a href="" class="float-right mr-2"><img src="'+cross+'"/></a><div class="row pt-2"><div class="col-lg-8"><h5>'+response.product+'</h5><p id="addons_'+response.product_id+'"></p></div><div class="col-lg-4 px-0 text-right pt-1"><p class="pt-3 font-size" id="total_'+response.id+'">PKR '+response.total_price+'</p><div class="btn-group order-btn"><button type="button" class="btn btn-border btn-setting" onClick="DcreaseQuantityByOne('+response.id+')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 30 30"><defs><linearGradient id="linear-gradient" x1="1" y1="0.283" x2="0" y2="0.946" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#be0a5e" /><stop offset="0.937" stop-color="#fd7d35" /><stop offset="1" stop-color="#ff8134" /></linearGradient></defs><g id="Group_112" data-name="Group 112" transform="translate(-1729 -1434)"><rect id="Rectangle_791" data-name="Rectangle 791" width="30" height="30" rx="4" transform="translate(1729 1434)" fill="url(#linear-gradient)"/><rect id="Rectangle_792" data-name="Rectangle 792" width="2.3" height="18.401" transform="translate(1753.401 1448) rotate(90)" fill="#fff"/></g></svg></button><button type="button" class="btn btn-setting" id="'+response.id+'_quantityvalue" disabled>'+response.quantity+'</button><button type="button" class="btn btn-border btn-setting" onClick="IncreaseQuantityByOne('+response.id+')" ><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 30 30" ><defs><linearGradient id="linear-gradient" x1="1" y1="0.283" x2="0" y2="0.946" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#be0a5e" /><stop offset="0.937" stop-color="#fd7d35" /><stop offset="1" stop-color="#ff8134" /></linearGradient></defs><g id="Group_113" data-name="Group 113" transform="translate(-1821 -1434)"><rect id="Rectangle_787" data-name="Rectangle 787" width="30" height="30" rx="4" transform="translate(1821 1434)" fill="url(#linear-gradient)"/><g id="Group_111" data-name="Group 111" transform="translate(1827 1440)"><rect id="Rectangle_789" data-name="Rectangle 789" width="2.3" height="18.401" transform="translate(8.05)" fill="#fff"/><rect id="Rectangle_790" data-name="Rectangle 790" width="2.3" height="18.401" transform="translate(18.401 8.05) rotate(90)" fill="#fff"/></g></g></svg></button></div></div></div></div>');
                  
                        for(var i=0; i<response.addon_names.length; i++){
                          $('#addons_'+response.product_id).append(response.addon_names[i]+', ');
                        }
                          //sub_total,tax,pre_order

                          var tax = document.getElementById('tax').value;
                          var commission = document.getElementById('commission').value;
                          var delivery_charge = document.getElementById('delivery_charge').value;
                          var delivery_fee = document.getElementById('delivery_fee').innerHTML;
                          delivery_fee =delivery_fee.split(" ");
                          delivery_fee= delivery_fee[1];
                          var sub_total = document.getElementById('sub_total').innerHTML;

                          sub_total =sub_total.split(" ");
                           //alert(sub_total);
                          sub_total = sub_total[1];

                          var minimum_purchase = document.getElementById('minimum_purchase').value;

                          if(Number(delivery_fee) == 0 && response.total_price > 0){
                            document.getElementById('delivery_fee').innerHTML ='PKR '+ Number(delivery_charge).toFixed(2);
                          }
                         // var min_purchase = document.getElementById('min_purchase').innerHTML;
                         
                          var sub_total_price = 0;
                          sub_total_price = Number(sub_total) + Number(response.total_price);
                         // alert(sub_total_price+','+sub_total);
                          document.getElementById('sub_total').innerHTML ='PKR '+sub_total_price.toFixed(2);



                           if(Number(minimum_purchase) > sub_total_price && minimum_purchase !=null)
                          {
                            //alert(minimum_purchase+','+sub_total_price);
                            document.getElementById('min_purchase').style.display = 'block';
                            var min = 0;
                            min = Number(minimum_purchase) - Number(sub_total_price);
                              document.getElementById('min_difference').style.display = 'block';
                            document.getElementById('diffrence_min').innerHTML ='PKR '+min.toFixed(2);
                          

                          }
                          else
                          {
                            document.getElementById('diffrence_min').innerHTML ='PRK '+0.00;
                            document.getElementById('min_difference').style.display = 'none';
                             document.getElementById('min_purchase').style.display = 'none';
                             document.getElementById('checkout').disabled =false;
                          }
                          var tax = document.getElementById('tax').value;
                           if(Number(tax) > 0 && tax !=null)
                          {
                            
                            document.getElementById('tax_per').style.display = 'block';
                            var tax_val = 0;
                            tax_val = Number((Number(tax) / 100) * Number(sub_total_price));
                           // alert(tax_val);
                              document.getElementById('tax_val').style.display = 'block';
                            document.getElementById('tax_value').innerHTML ='PKR '+tax_val.toFixed(2);
                          

                          }
                          
                          var total_price = 0;
                         // alert(sub_total_price+','+delivery_charge+','+tax_val);
                          total_price = Number(sub_total_price) + Number(delivery_charge) + Number(tax_val);
                          document.getElementById('overall_amount').innerHTML = 'PKR '+total_price.toFixed(2);

                          


                          document.getElementById('MenuItems_'+prod_id).reset();
                    }


               }
           });
   }
  


</script>
@endsection
