<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PremiereRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required|integer',
            'category_id' => 'required',
            'telegram_status' => 'nullable',
            'translates' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name_oz.required' => 'Nomi maydoni to\'ldirish talab qilinadi',
            'name_uz.required' => 'Номи майдони тўлдириш талаб қилинади',
            'name_ru.required' => 'Поле «Имя» обязательно для заполнения.',
            'name_en.required' => 'The name field is required.',
            'description_oz.required' => 'Qisqacha ma\'lumot maydoni to\'ldirish talab qilinadi',
            'description_uz.required' => 'Қисқача маълумот майдони тўлдириш талаб қилинади',
            'description_ru.required' => 'Обязательно заполните краткое информационное поле.',
            'description_en.required' => 'A short information field is required.',
            'content_oz.required' => 'To\'liq ma\'lumotlar maydoni to\'lidirish talab qilinadi',
            'content_uz.required' => 'Тўлиқ маълумотлар майдони тўлидириш талаб қилинади',
            'content_ru.required' => 'Поле данных обязательно для заполнения.',
            'content_en.required' => 'Complete data field is required.',
            'image.required' => 'Rasm maydoni to\'ldirish talab qilinadi',
            'category_id.required' => 'Kategoriya maydoni to\'ldirish talab qilinadi',
        ];
    }
}
