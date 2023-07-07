<?php
namespace App\Http\Requests\Admin;
use Auth;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubManagementRequest extends Request
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
        ];

        return Validator::make($data, $validationArray, self::messages());
    }
    public static function messages()
    {
        return [
            'name.required' => 'sub area name is required',
            'status.required' => 'Status is required',

        ];
    }
}
