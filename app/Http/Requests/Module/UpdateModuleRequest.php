<?php

namespace App\Http\Requests\Module;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'icon' => 'required|unique:module_details,icon,'.$this->module_detail_id.',id,deleted_at,NULL',
            'name' => 'required|unique:module_details,name,'.$this->module_detail_id.',id,deleted_at,NULL',
            'description' => 'required',
        ];
    }
}
