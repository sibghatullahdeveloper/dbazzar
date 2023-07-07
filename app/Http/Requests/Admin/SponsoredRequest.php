<?php
namespace App\Http\Requests\Admin;
use Auth;
use Illuminate\Validation\Factory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SponsoredRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function validator(array $data)
    {
        $validationArray = [
            'entity' =>'required',
            'start_date' =>'required|date|before:end_date',
            'end_date' =>'required|date',
            'status' => 'required',
        ];


        return Validator::make($data, $validationArray, self::messages());
    }
    public static function messages()
    {
        return [
            'entity.required' => 'Entity is required',
            'start_date.required' => 'Start date is required',
            'start_date.date' => 'Start date type must be date',
            'start_date.before:end_date' => 'Start date must be smaller than end date',
            'end_date.required' => 'End date is required',
            'end_date.date' => 'End date type must be date',
            'status.required' => 'Status is required',

        ];
    }
}
