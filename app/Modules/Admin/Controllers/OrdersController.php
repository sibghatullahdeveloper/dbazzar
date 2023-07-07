<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SponsoredRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Services\OrdersService;
use App\Services\OrderStatusService;
use App\Model\FoodItems;
use App\Model\AddOns;
use App\Model\OrderStatus;
use App\Model\Order;
use App\Model\City;
use App\Model\Countires;


class OrdersController extends Controller
{
    protected $OrdersService;
    protected $OrderStatusService;

    public function __construct(OrdersService $OrdersService, OrderStatusService $OrderStatusService)
    {
        $this->OrdersService = $OrdersService;
        $this->OrderStatusService = $OrderStatusService;
    }

    public function index()
    {
        $orders_list= $this->OrdersService->OrdersList();

        foreach ($orders_list as $list){

            foreach ($list->orderdetails as $id) {
                
                $product = $id->product_id;
                $addons_array = json_decode($id->addons);

                $products_name = FoodItems::where('id', $product)
                ->get();

                $addons_name = AddOns::whereIn('id', $addons_array)
                ->get();
                $id->products_name=$products_name;
                $id->addons_name=$addons_name;
            }

        }
        //dd($orders_list);

        return view('Admin::OrderManagement.index')->with('lists', $orders_list);
    }
    
    public function orderDetailsAction(Request $request){


        if($request->ajax()){
            
            $output = '';
            $header = '';
            $footer = '';
            $query = $request->get('query');
            
            if($query != ''){

                $orders= $this->OrdersService->OrdersById($query);

                foreach ($orders as $list){    
                    foreach ($list->orderdetails as $id) {

                        $product = $id->product_id;
                        $addons_array = json_decode($id->addons);

                        $products_name = FoodItems::where('id', $product)
                        ->get();

                        $addons_name = AddOns::whereIn('id', $addons_array)
                        ->get();
                        $id->products_name=$products_name;
                        $id->addons_name=$addons_name;

                    }
                }

                foreach ($orders as $entity_address) {
                    $address = json_decode($entity_address->entitybranch->address, true);
                    $city = City::select('name')->where('id',$address[0]["city"])->first();
                    $country = Countires::select('country')->where('id',$address[0]["country"])->first();
                }
                
                foreach ($orders as $order) {
                    
                    $header .= "<h5 class='modal-title'>Click On Order To View Its Detail</h5>
                                <button type='button' class='close' data-dismiss='modal'>&times;</button>";

                    $output .= "<div class='panel panel-default'>
                        <div class='panel-heading accordion-toggle question-toggle collapsed' data-toggle='collapse' data-parent='#faqAccordion' data-target='#order_".$order->id."'>
                            <h4 class='panel-title'>
                                <a href='#' class='ing'>Order # ".$order->id."</a>
                            </h4>
                            <h5><span class='label label-primary'>Entity Branch Details</span></h5>
                            <table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th>Merchant</th>
                                        <th>Merchant#</th>
                                        <th>Merchant Address</th>
                                        <th>Tansaction #</th>
                                        <th>Payment Mode</th>
                                        <th>Tax</th>
                                        <th>Delivery Fee</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>".$order->entitybranch->title."</td>
                                        <td>".$order->entitybranch->phone."</td>
                                        <td>Street#".$address[0]["street_no"].", City:".$city->name.", Country:".$country->country.", ZipCode:".$address[0]["zip_code"].", State:".$address[0]["state"]."</td>
                                        <td>".$order->payment_id."</td>
                                        <td>".$order->payment_mode."</td>
                                        <td>"; if($order->tax == null) {$output .= "PKR 0.00";} else {$output .= "PKR ".$order->tax." ";}$output .= "</td>
                                        <td>";if($order->entitybranch->delivery_charge == null){ $output .= "PKR 0.00"; } else { $output .= "PKR ".$order->entitybranch->delivery_charge.""; } $output .= "</td>
                                        <td>PKR ".$order->total_amount."</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            
                        <div id='order_".$order->id."' class='panel-collapse collapse' style='height: 0px;'>
                            <div class='panel-body'>
                            <h5><span class='label label-primary'>Customer Details</span></h5>
                                <table class='table table-striped'>
                                <thead>
                                    <tr>
                                        <th>CustomerId#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Contact#</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>".$order->consumer->id."</td>
                                        <td>".$order->consumer->first_name."</td>
                                        <td>".$order->consumer->last_name."</td>
                                        <td>".$order->consumer->contact_number."</td>
                                        <td>".$order->consumer->email."</td>
                                        <td>--</td>
                                    </tr>
                                </tbody>
                                </table>

                            </div>
                            <div class='panel-body'>
                                <h5><span class='label label-primary'>Order Details</span></h5>

                                <table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Addons</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                              
                                    <tbody>";
                                        foreach($order->orderdetails as $item){
                                            foreach($item->products_name as $product){
                                                $output .= "<tr>
                                                    <td>".$product->name."</td>";
                                            }
                                                $output .= "<td>";
                                                    if($item->addons_name != null){
                                                        foreach($item->addons_name as $addon){
                                                            $output .= "".$addon->name.",";
                                                        }
                                                    }else{
                                                        $output .= "--";
                                                    }
                                                $output .= "</td>
                                                <td>".$item->quantity."</td>
                                                <td>".$item->amount."</td>
                                            </tr>";
                                        }
                                    $output .= "</tbody>
                                </table>
                            </div>
                        </div>
                    </div>";

                    $footer = "<button type='button' class='btn btn-link' data-dismiss='modal'>Close</button>";
                }
            }
        }
        $dataArr = array(
                'body_data'  => $output,
                'header'  => $header,
                'footer' => $footer
            );

        echo json_encode($dataArr);
    }

    public function statusDetailsAction(Request $request){


        if($request->ajax()){
            
            $output = '';
            $header = '';
            $footer = '';
            $query = $request->get('query');
            
            if($query != ''){

                $allstatus = OrderStatus::get();

                $order= $this->OrdersService->OrdersById($query);
                
                foreach ($order as $orders) {
                    $current_status_id = $orders->orderstatus->id;
                    $order_id = $orders->id;
                }
                //dd($order_id);

                $header = "<h5 class='modal-title'>Order Status</h5>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>";

                $output .= "
                    <select data-placeholder='select' name='".$order_id."' id='update_status' class='form-control select'>
                        <option>Select</option>";
                        
                        foreach ($allstatus as $status) {
                            $output .= "<option value='".$status->id."'";
                            
                            if($status ->id == $current_status_id){
                                
                                $output .="selected>".$status->name."</option>";
                            }else{
                                
                                $output .=">".$status->name."</option>";
                            }   
                        }
                        
                  $output .= "</select>
                ";

                $footer = "<button type='button' class='btn btn-link' data-dismiss='modal' id='status_modal'>Close</button>
                  <button type='submit' id='submit_status' class='btn bg-primary'>Submit form</button>";
            }
        }
        $dataArr = array(
                'body_data'  => $output,
                'header'  => $header,
                'footer' => $footer
            );

        echo json_encode($dataArr);
    }

    public function statusStoreAction(Request $request){


        if($request->ajax()){
            
            $output = '';
            $message = '';

            $status_id = $request->get('status_id');
            $order_id = $request->get('order_id');
            
            if($status_id != '' && $order_id != ''){

                $orderstatus = new Order();


                if($order_id != ''){

                    $orderstatus->where('id',$order_id)
                        ->update([
                            'order_status_id' => $status_id,
                            'updated_at' =>Carbon::now()
                        ]);
                    
                    $message .= "Status Updated Successfully";
                
                }else{
                    $message .= "Status is not Updated Successfully";
                }       
            }

            $orders_list= $this->OrdersService->OrdersList();

            foreach ($orders_list as $list){

                foreach ($list->orderdetails as $id) {
                    
                    $product = $id->product_id;
                    $addons_array = json_decode($id->addons);

                    $products_name = FoodItems::where('id', $product)
                    ->get();

                    $addons_name = AddOns::whereIn('id', $addons_array)
                    ->get();
                    $id->products_name=$products_name;
                    $id->addons_name=$addons_name;
                }

            }

            foreach($orders_list as $info){
                
                $output .= "<tr>
                    <td>".$info->id."</td>";
                  
                    if($info->entitybranch){
                        $output .= "<td>".$info->entitybranch->title."</td>";
                    }

                    $output .= "<td>".$info->name."</td>

                    <td>";
                        foreach($info->orderdetails as $products){
                            foreach($products->products_name as $name){
                                $output .= "".$name->name." -"; 
                            }
                        }
                    $output .= "</td>

                    <td>".$info->payment_mode."</td>
                    <td>".$info->total_amount."</td>
                    <td>".$info->created_at."</td>";

                    if($info->orderstatus){
                  
                        if ($info->orderstatus->id == 0){
                            $output .= "<td><span class='badge badge-danger'>".$info->orderstatus->name."</span></td>";
                        }
                        

                        if ($info->orderstatus->id != 0){
                            $output .= "<td><span class='badge badge-success'>".$info->orderstatus->name."</span></td>";
                        }
                        
                    
                    }

                    $output .= "<td class='text-center'>
                        <div class='list-icons'>
                            <div class='dropdown'>
                                <button type='button' id='edit_status' value='".$info->id."' class='btn btn-primary'><i class='icon-pencil3'></i></button>
                                |
                                <button type='button' id='view' value='".$info->id."' class='btn btn-light'><i class='icon-eye2'></i></button>
                            </div>
                        </div>
                    </td>
                </tr>";
            }
        }

        $dataArr = array(
                'table_data'  => $output,
                'statusUpdatemessage'  => $message
            );

        echo json_encode($dataArr);
    }

}



