<?php

namespace App\Http\Requests\Setting;

use App\Abstracts\Http\FormRequest;

class Currency extends FormRequest
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
            $id = is_numeric($this->currency) ? $this->currency : $this->currency->getAttribute('id');
        } else {
            $id = -1;
        }
        // Get company id
        $company_id = $this->request->get('company_id');

        if(empty($company_id)){
            $company_id = session('company_id');
        }

        return [
            'name' => 'required|string',
            'code' => 'required|string|unique:currencies,NULL,' . $id . ',id,company_id,' . $company_id . ',deleted_at,NULL',
            'rate' => 'required',
            'enabled' => 'integer|boolean',
            'default_currency' => 'boolean',
            'symbol_first' => 'nullable|boolean',
        ];
    }
}
