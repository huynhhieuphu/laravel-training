<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $unique = 'unique:users,user_email';
        if(!empty(session('ss_user_id'))){
            $userId = session('ss_user_id');
            $unique .= ','. $userId . ',user_id';
        }

        return [
            'user_firstname' => 'required|string|max:100',
            'user_lastname' => 'nullable|string|max:100',
            'user_email' => 'required|email|'.$unique,
            'user_group_id' => ['required','integer', function($attribute, $value, $fail){
                if($value <= 0){
                    $fail('Invalid data');
                }
            }],
            'user_status' => 'required|integer|in:0,1',
        ];
    }
}
