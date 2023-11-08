<?php

namespace App\Http\Requests\Hero;

use Illuminate\Foundation\Http\FormRequest;

class HeroManageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'heading' => 'required|string|min:3|max:100',
            'button_text' => 'required|string|min:3|max:50',
            'sub_heading' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ];
    }
}
