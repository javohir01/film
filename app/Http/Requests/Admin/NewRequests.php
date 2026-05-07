<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewRequests extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'              => 'required|string',
            'category_id'       => 'required|integer',
            'status'            => 'required|integer',
            'description'       => 'required',
            'content'           => 'required',
            'translates'        => 'required|in:oz,uz,ru,en',
            'images'            => 'nullable|image|mimes:png,jpeg,jpg|max:2048',
            'telegram_status'   => 'nullable',
        ];
    }
}
