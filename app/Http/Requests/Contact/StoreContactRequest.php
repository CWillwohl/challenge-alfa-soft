<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
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
        return [
            'name' => ['required', 'min:5', 'max:255'],
            'contact' => ['required', 'digits:9', Rule::unique('contacts')->whereNull('deleted_at')],
            'email' => ['required', 'email', 'max:255', Rule::unique('contacts')->whereNull('deleted_at')],
        ];
    }
}
