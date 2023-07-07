<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Http\Requests\Admin\MerchantRequest;
use App\Services\OrdersService;
use App\Services\OrderStatusService;
use App\Model\OrderItem;
use App\Model\FoodItems;
use App\Model\AddOns;
use View;
use Carbon\Carbon;
use App\User;

class DashboardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    protected $OrdersService;
    protected $OrderStatusService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct(OrdersService $OrdersService, OrderStatusService $OrderStatusService)
    {
        $this->OrdersService = $OrdersService;
        $this->OrderStatusService = $OrderStatusService;
    }
    public function index(){

       $orders_list= $this->OrdersService->OrdersListForDashboard();

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
      //  dd($orders_list);
        return view('Admin::dashboard.index')->with('lists', $orders_list);
    }

   

}
