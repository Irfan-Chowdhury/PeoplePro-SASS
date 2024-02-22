<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $data = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'company_name' => 'required|string|min:3',
            'contact_no' => 'required|numeric',
            'email' => 'required|email|max:50|unique:customers,email,'.$this->customer_id.',id,deleted_at,NULL',
            'username' => ['required', 'regex:/^\S*$/', 'string','min:3','max:50','unique:customers,username,'.$this->customer_id.',id,deleted_at,NULL'],
        ];


        if($this->password)
            $data['password'] = 'required|string|min:5|confirmed';

        return $data;
    }
}
