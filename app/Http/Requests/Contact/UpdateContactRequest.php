<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
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
        $contactId = $this->contact;

        if(!gettype($this->contact) == 'string') {
            $contactId = $this->contact->id;
        }

        return [
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'contactData' => [
                'required',
                'digits:9',
                Rule::unique('contacts', 'contact')->whereNull('deleted_at')->ignore($contactId)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('contacts', 'email')->whereNull('deleted_at')->ignore($contactId)
            ],
        ];
    }
}
