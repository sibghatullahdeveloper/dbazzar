
@extends('layouts.backend')

@section('content')

<div class="img">
  <img src="{{asset('images/entitybranch/'.$header)}}" width="100%">
</div>

<div class="row  m-0">
  <div class="col-lg-2"></div>
  <div class="col-lg-8 col-md-12 col-sm-12 col-12 border-cover">
    <div class="row d-flex ">
      <div class="col-lg-9 order-sm-2 order-2  order-md-1 col-md-9 col-sm-9 col-12">
            <div class=" p-3">
            <h2 class="pt-3">{{$entity->title}} <span class="img-s pt-2">3255 reviews</span></h2>
            <div class="btn-group btn-group-sm">
            @foreach($entity->tags_name as $tag)
    <button type="button" class="btn btn-dark btn-s">#{{$tag['name']}}</button>
    @endforeach
  </div>
  <p class="pt-3 cover-img">{{$entity->about}}</p>

  <h3 class=""><i class="fas fa-star"></i> <b> 4.2</b> <span class="time text-center">Close 12:00 PM</span>  </h3>
  </div>
  </div>
  <div class="col-lg-3 order-sm-1 order-md-2 order-1 col-md-3 col-sm-3 col-12">
    <span class=""><img src="{{asset('images/entitybranch/'.$header)}}" width="100%" class="border-img"></span>

  </div>
  </div>
  </div>
  <div class="col-lg-2"></div>
</div>



<div class="box-shadow">
<div class="container">
  <!-- Nav pills -->
  <ul class="nav  tab-nav nav-pills" role="tablist">
  @foreach($productCat as $cat)
    <li class="nav-item mx-auto">
      <a class="nav-link" href="#menu_{{$cat->name}}">{{$cat->name}}</a>
    </li>
    @endforeach
  </ul>
</div>
</div>
  <!-- Tab panes -->
  <div class="container">
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
     <div class="row">

      <div class="col-lg-7 col-xl-7 px-3 my-5">
      @foreach($productCat as $cat)
      <div id="menu_{{$cat->name}}">
       <h5 class="text-center font-weight-bold">{{$cat->name}}</h5>
       @foreach($products as $prod)

       @if($prod->p_cat_id == $cat->id)
        <div class="row bor-color py-4 px-2 my-4">
          <div class="col-lg-4 col-xl-4 pr-0 pt-1 col-md-12 col-sm-6 col-12 ">
          @if($prod->image != "NULL")
            <img src="{{asset('images/foodItems_images/'.$prod->image)}}" width="100%" class="img-style">
              @endif
          </div>

          <div class="col-lg-5 col-xl-5 col-md-6 col-sm-12 col-12">
            <h3 class="font-weight-bold media-p">{{$prod->name}}</h3>
            <p class="pc">{{$prod->description}}<span class="f-right"></span></p>
          </div>
           <div class="col-lg-3 col-xl-3 col-md-6 text-right col-sm-12 col-12 ">
             <h5 class="col-p-none mb-4 f-right">PKR {{$prod->display_price}}</h5>
         <button type="button" data-toggle="modal" data-target="#exampleModalLong_{{$prod->id}}" class="btn bg-transparent p-0"><i class="fas fa-2x fa-plus-square"></i></button>
           </div>
        </div>

        @endif

        @endforeach

        </div>
        @endforeach
      </div>

      <div class="col-lg-5 px-3 py-4">
        <aside>
        <div class="box-shadow1 p-3">
        <h2 class="font-weight-bold h2-s text-center">Your order</h2>
        @if(count($cart) > 0)
        <?php $total_amount = 0;?>
        @foreach($cart as $item)
        <div class="row box-shadow1 mx-1 text-center">
        <div class="row">
          <div class="col-lg-3 pt-2">

                        <div class="btn-group">
                          <button type="button" class="btn btn-border btn-setting" onClick="DcreaseQuantityByOne({{$item->id}})"><i class="fas fa-minus"></i></button>
                          <button type="button" class="btn btn-setting" id="{{$item->id}}_quantityvalue" disabled>{{$item->quantity}}</button>
                          <button type="button" class="btn btn-border btn-setting" onClick="IncreaseQuantityByOne({{$item->id}})"><i class="fas fa-plus"></i></button>
                        </div>

           </div>
                <div class="col-lg-6">
                  <p class="p-h py-3">{{$item->product}}</p>
                   @foreach($item->addon_names as $name)
                   
                        <p class="line-height p-h1"> {{$name}},</p>
                   
                    @endforeach
                  
                  </div>
                <div class="col-lg-3 pt-1">
                  <p class="pt-3 font-size">PKR <span id="total_{{$item->id}}">{{$item->total_price}}</span></p>
                </div>
                <?php $total_amount = $total_amount + $item->total_price;?>
                </div>
                
                   
               
         </div><br>
          <div class="row box-shadow1 mx-1 text-center" id="cartitem">
          </div>
         @endforeach
            <div class="box-shadow1 my-2">
              <h5 class="pt-3 cr pl-3">Subtotal<span class="fl-r">PKR <p id="sub_total_{{$item->id}}">{{$total_amount}}</p></span></h5>
              <h5 class="pb-3 cr pl-3">Delivery fee<span class="fl-r">PKR <p>{{$entity->delivery_charge}}</p></span></h5>
            </div>
            <?php $overallTotal = $total_amount + $entity->delivery_charge;?>
            <div class="box-shadow1 my-2">
              <h3 class="p-3 font-size1 font-weight-bold">Total<span class="mr">PKR <strong id="overall_amount">{{$overallTotal}}</strong></span></h3>
            </div>


            <div class="box-shadow1 back-color my-3">
            @if(\Auth::guard('customer')->user())
              <a href="{{route('Checkout')}}"><h3 class="p-3 text-white font-size1 font-weight-bold">Check Out<span class="mr-icon text-white"><i class="fas fa-arrow-right"></i></span></h3></a>
            @else
             <a href="{{route('guestCheckout')}}"><h3 class="p-3 text-white font-size1 font-weight-bold">Check Out<span class="mr-icon text-white"><i class="fas fa-arrow-right"></i></span></h3></a>
            @endif
            </div>

            @endif


      </div>
     </aside>
      </div>
     </div>
    </div>


  </div>
</div>





@foreach($products as $prod)

<!-- modal started here -->

<!-- Modal -->
<div class="modal fade" id="exampleModalLong_{{$prod->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">

 <form  id="MenuItems_{{$prod->id}}" name="MenuItems_{{$prod->id}}" action="/">
 {{ csrf_field() }}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
       <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLong_{{$prod->id}}">{{$prod->name}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <img src="{{asset('images/foodItems_images/'.$prod->image)}}" width="250px" height="250px" class="img-fluid">
        <div class="container">
          <div class="row">
          <input type="hidden" name="branch_id" value="{{$entity->id}}">
            <div class="col-md-8">
               <h1 class="media-text">{{$prod->name}}</h1>
               <p class="model-text mb-3">{{$prod->description}}</p>
            </div>
            <div class="col-md-4 text-right"><p class="pt-2 font-weight-bold">PKR <strong id="{{$prod->id}}_base_price">{{$prod->price}}</strong></p></div>
            <input type="hidden" id="{{$prod->id}}_total_price" name="{{$prod->id}}_total_price" value="{{$prod->price}}">
            <input type="hidden" name="prod_id" value="{{$prod->id}}">
          </div>
        </div>
          
              @if($prod->addonCatogories)
              @foreach($prod->addonCatogories as $categories)
              <div class="container modal-shadow py-3 my-4">
          <div class="row">
            <div class="col-md-8">
               <h1 class="media-text">{{$categories->name}}</h1>
               <p class="media-text">@if($categories->selection_type == "SINGLE")Select 1 @else Select {{$categories->min_selection}} up to {{$categories->max_selection}} @endif</p>
                @if($categories->addons)

                   <?php $name_r = explode(' ',$categories->name);  $name_c = count($name_r); $name_r = $name_r[$name_c - 1]?>
                  <input type="hidden" id="{{$prod->id}}_radio_cat_<?php echo $name_r; ?>_{{$categories->id}}" name="{{$prod->id}}_radio_cat_<?php echo $name_r; ?>_{{$categories->id}}" value=" ">
              @foreach($categories->addons as $addons)
                  @if($categories->selection_type == "SINGLE")
                            <div class="py-4">
                   <label class="containerradio">{{$addons->name}}
                   <?php $name_r = explode(' ',$categories->name);  $name_c = count($name_r); $name_r = $name_r[$name_c - 1]?>
                       <input type="radio"  id="cat_<?php echo $name_r; ?>" name="cat_<?php echo $name_r; ?>" onClick="SingleSelect({{$addons->price}},{{$categories->id}},{{$addons->id}},{{$prod->id}},'{{$categories->name}}')">
                       
                       <span class="checkmarkradio"></span>
                   </label>
                  
                            </div>
                @else
                            <div class="py-4">
                       <label class="containercheckbox">{{$addons->name}}
                         <?php $name_r = explode(' ',$addons->name);  $name_c = count($name_r); $name_r = $name_r[$name_c - 1]?>
                           <input type="checkbox"  id="add_<?php echo $name_r;?>" onchange="MultiSelect({{$addons->price}},{{$categories->id}}, {{$addons->id}},{{$prod->id}},'{{$addons->name}}')">
                            
                           <span class="checkmarkbox"></span>
                       </label>
                        <input type="hidden" name="{{$prod->id}}_check_add_<?php echo $name_r;?>_{{$addons->id}}" id="{{$prod->id}}_check_add_<?php echo $name_r;?>_{{$addons->id}}" value="">
               </div>
                 @endif

                @endforeach
                    @endif
            </div>
            <div class="col-md-4 text-right"><p class="pt-2 font-weight-bold model-t-color model-text">@if($categories->required > 0) {{$categories->required}} REQUIRED @endif</p></div>
          </div>
          
        </div>

          @endforeach
            @endif

        <div class="modal-shadow py-5">
          <div class="">
            <div class="container">
              <div class="form-group">
                <label for="comment" class="font-weight-bold">You can write down here any special instructions</label>
                <textarea class="form-control" rows="5" id="{{$prod->id}}_comment" name="{{$prod->id}}_comment" placeholder="E.g No mayo"></textarea>
              </div>
          </div>
          </div>
        </div>

      </div>
      <div class="model-footer container">
        <div class="btn-group pt-3">
        <button type="button" class="btn btn-outline-warning" onClick="decrease_quantity({{$prod->id}})"><i class="fas fa-1x fa-minus"></i></button>
        <button type="button" id="{{$prod->id}}_qty_value" class="btn btn-setting" disabled>1</button>
        <button type="button" class="btn btn-outline-warning" onClick="increase_quantity({{$prod->id}})"><i class="fas fa-1x fa-plus"></i></button>
        </div>
        <input type="hidden" name="{{$prod->id}}_quantity" id="{{$prod->id}}_quantity" value="1">
        <span class="model-btn">

        <div class="box-shadow1 back-color my-3">  
       <a onclick="submitform({{$prod->id}})" style="cursor:pointer"> <h3 class="p-3 text-white font-size1 font-weight-bold" ><strong id="{{$prod->id}}_item_total">PKR {{$prod->price}}</strong> <span class="mr-icon text-white">
          <i class="fas pl-5 fa-arrow-right"></i></span></h3>
        </a></div>
        </span>
      </div>
    </div>
  </div>
 </form>
</div>

@endforeach
 @yield('js_after')
 <script language="JavaScript">


//  window.addEventListener('beforeunload', (event) => {

 
//   // Cancel the event as stated by the standard.
//   event.preventDefault();
//   // Chrome requires returnValue to be set.
//   alert('are you there ?');
//        $.ajax({
//                url: '{{route('emptycart')}}',
//                type: 'post',
//                data:{"_token": "{{ csrf_token() }}"},
//                dataType: 'json',
//                success: function(response){
//                    console.log(response,"result");
                 
//                }
//            });
//   event.returnValue = 'are you sure';


// });

  
</script>
<script>
  
function SingleSelect(price,cat,addon,prod_id,name){
      //alert("asdasda");
      //alert(price+ ","+cat+","+addon+","+name+","+prod_id); 
      var stingtostore = cat+"_"+addon;
      var res = name.split(" ");
      var new_id = res[res.length - 1];
      document.getElementById(prod_id+"_radio_cat_"+new_id+"_"+cat).value = addon;

      var prod_price = document.getElementById(prod_id+'_total_price').value;

      var total_price = Number(price) + Number(prod_price);

      document.getElementById(prod_id+"_base_price").innerHTML = total_price;
      document.getElementById(prod_id+'_total_price').value = total_price;
      document.getElementById(prod_id+ '_item_total').innerHTML = "PKR "+total_price;
}


function MultiSelect(price,cat,addon,prod_id,name){
        var stingtostore = cat+"_"+addon;
        var res = name.split(" ");
        var new_id = res[res.length - 1];
        //alert(prod_id+"_check_add_"+new_id+"_"+addon);
        document.getElementById(prod_id+"_check_add_"+new_id+"_"+addon).value = addon;
        var prod_price = document.getElementById(prod_id+'_total_price').value;
        var total_price = Number(price) + Number(prod_price);

        document.getElementById(prod_id+'_base_price').innerHTML = total_price;
        document.getElementById(prod_id+'_total_price').value = total_price;
        document.getElementById(prod_id+ '_item_total').innerHTML = "PKR "+total_price;

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
function DcreaseQuantityByOne(id, price){

  var price = document.getElementById("total_"+id).innerHTML;
  if(Number(price) > 0){
    var Qty = document.getElementById(id+"_quantityvalue").innerHTML;
  var single_price= Number(price) / Number(Qty);
  Qty = Number(Qty) - 1;
  if(Qty > 0){
    var new_price = Number(price) - Number(single_price);
    document.getElementById("total_"+id).innerHTML = new_price.toFixed(2);
    var sub_total =document.getElementById("sub_total_"+id).innerHTML;
    sub_total  = Number(sub_total) - Number(single_price);
    document.getElementById("sub_total_"+id).innerHTML =sub_total.toFixed(2);
    
    document.getElementById(id+ "_quantityvalue").innerHTML = Qty;
    var total_amount = document.getElementById("overall_amount").innerHTML;

     total_amount = Number(total_amount) - Number(single_price);
    document.getElementById("overall_amount").innerHTML = total_amount.toFixed(2);

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
                 location.reload(true);
               }
           });
      }
  }
}

function IncreaseQuantityByOne(id, price){

var price = document.getElementById("total_"+id).innerHTML;
//alert(price+","+Qty);
  if(Number(price) > 0){
    var Qty = document.getElementById(id+"_quantityvalue").innerHTML;
    var single_price= Number(price) / Number(Qty);
    Qty =  Number(Qty) + 1;
    var new_price = Number(price) + Number(single_price);
    document.getElementById("total_"+id).innerHTML = new_price.toFixed(2);
     var sub_total =document.getElementById("sub_total_"+id).innerHTML;
    sub_total  = Number(sub_total) + Number(single_price);
    document.getElementById("sub_total_"+id).innerHTML =sub_total.toFixed(2);
    
    document.getElementById(id+ "_quantityvalue").innerHTML =Qty;
    var total_amount = document.getElementById("overall_amount").innerHTML;

     total_amount = Number(total_amount) + Number(single_price);
    document.getElementById("overall_amount").innerHTML = total_amount.toFixed(2);

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

      $.ajax({
               url: '{{route('addItemTocart')}}',
               type: 'post',
               data:form,
               dataType: 'json',
               success: function(response){
                   console.log(response.length,"result");
                   $('#exampleModalLong_'+prod_id).modal('hide');
                    console.log(response);
                    if(response.length > 0){
                        document.getElementById('cartitem').innerHTML = '<div class="row">'+response.product+'</div>'
                    }


                 location.reload(true);
               }
           });
   }
  


</script>
@endsection
