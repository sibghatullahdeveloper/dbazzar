<?php
namespace App\Http\Requests\Admin;
use Auth;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class EntitySettingsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function validator(array $data)
    {
        $validationArray = [
            'commission' =>'required'  ,
            'minimum_purchase' =>'required',
            'tax' => 'required',
            'delivery_time' => 'required',
            'packaging_charge' => 'required',
            'status_message' => 'required',
        ];
        return Validator::make($data, $validationArray, self::messages());
    }

    public static function messages(){
        return [
            'commission.required' =>'commission is required',
            'minimum_purchase.required' =>'minimum purchase is required',
            'tax.required' =>'tax is required',
            'delivery_time.required' =>'delivery time is required',
            'packaging_charge.required' =>'packaging charge is required',
            'status_message.required' =>'status message charge is required',
        ];
    }
}
