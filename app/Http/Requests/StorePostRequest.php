<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()// ဒီuserက ဒီrequestကို လုပ်ဖို့ authorize ဖြစ် မဖြစ် လိုအပ်။ လိုအပ်ရင်true မလိုအပ်ရင်false ပြန်။
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
        return [
            'name' => 'required|unique:posts|max:255', // name or email ထည့်တာ unique ဖြစ်/မတူရ။
            'description' => 'required|max:255',
            'category_id' => 'required',
            // name,description,category_id is name attribute in input form
        ];
    }

    // https://laravel.com/docs/8.x/validation#customizing-the-error-messages
    // Customizing error messages
    public function messages()
    {
        return [
            'name.required' => 'A Name is required',
            'description.required' => 'A Description is required',
            'category_id.required' => 'A Category is required',
            // name,description,category_id is name attribute in input form

        ];
    }
}
