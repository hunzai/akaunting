<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class Role extends FormRequest
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
        // Check if store or update
        if ($this->getMethod() == 'PATCH') {
            $id = is_numeric($this->role) ? $this->role : $this->role->getAttribute('id');
        } else {
            $id = 0;
        }

        return [
            'name' => 'required|string|unique:roles,name,' . $id,
            'display_name' => 'required|string',
            'permissions' => 'required'
        ];
    }
}
