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
use App\Model\ConsumerUser;



class CustomerController extends Controller
{

	protected $OrdersService;

	public function __construct(OrdersService $OrdersService)
    {
        $this->OrdersService = $OrdersService;
    }

    public function index(){
    	
    	$consumers = ConsumerUser::where('user_type', 'CUSTOMER')->get();

    	return view('Admin::CustomerManagement.index')->with('lists', $consumers);
    }

    public function CustomerOrdersAction(Request $request){


        if($request->ajax()){
            
            $output = '';
            $query = $request->get('query');
            
            if($query != ''){

                $orders= $this->OrdersService->OrdersByCustomerId($query);

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
                }
            }
        }

        echo json_encode($output);
    }






}