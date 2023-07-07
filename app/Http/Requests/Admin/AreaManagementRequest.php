<?php
namespace App\Http\Requests\Admin;
use Auth;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AreaManagementRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function validator(array $data)
    {
        $validationArray = [
            'name' =>'required',
            'status' =>'required',
            'country_id' =>'required',
            'city_id' =>'required',
        ];

        return Validator::make($data, $validationArray, self::messages());
    }
    public static function messages()
    {
        return [
            'name.required' => 'Area name is required',
            'status.required' => 'Status is required',
            'country_id.required' => 'Country is required',
            'city_id.required' => 'City is required',


        ];
    }
}
