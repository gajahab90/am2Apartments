<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
     * @param Request $request
     * @return array
     */
    public function rules(Request $request) {
        if($request->isMethod('POST')) {
            $returnRules = [
                'name' => 'required|string|max:255'
            ];
        } else if($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            $returnRules = [
                'name' => 'string|max:255'
            ];
        } else {
            $returnRules = [
                'page' => 'integer|gt:0',
                'per_page' => 'integer|gt:0'
            ];
        }

        return $returnRules;
    }
}
