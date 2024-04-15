<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type_id' => 'required|exists:types,id',
            'image' => 'nullable|image',

        ];
    }

        /**
     * Get the validation message
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere un valore testuale',
            'title.max' => 'Il titolo deve essere massimo di :max caratteri',
            'content.required' => 'Il contenuto è obbligatorio',
            'content.string' => 'Il contenuto deve essere un valore testuale',
            'type_id.required' => 'Devi scegliere una tipologia!'

        ];
    }

}
