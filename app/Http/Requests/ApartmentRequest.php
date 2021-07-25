<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApartmentRequest extends FormRequest
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
                'name' => 'required|string|max:255',
                'price' => 'required|numeric|gt:0',
                'currency' => 'required|string|size:3',
                'description' => 'string|max:2000',
                'properties' => 'json',
                'category_id' => 'required|integer|gt:0'
            ];
         } else if($request->isMethod('PUT') || $request->isMethod('PATCH')) {
            $returnRules = [
                'name' => 'string|max:255',
                'price' => 'numeric|gt:0',
                'currency' => 'string|size:3',
                'description' => 'string|max:2000',
                'properties' => 'json',
                'category_id' => 'integer|gt:0'
            ];
        } else {
            $returnRules = [
                'id' => 'integer|gt:0',
                'name' => 'string|max:255',
                'price' => 'array|size:2',
                'price.value' => 'numeric|gt:0',
                'price.arithmetic' => [Rule::in(['<', '=', '>', '<=', '>='])],
                'rating' => 'array|size:2',
                'rating.value' => 'numeric|gt:0',
                'rating.arithmetic' => [Rule::in(['<', '=', '>', '<=', '>='])],
                'currency' => 'string|size:3',
                'description' => 'string|max:2000',
                'properties' => 'json',
                'category_id' => 'integer|gt:0',
                'size' => 'array|size:2',
                'size.value' => 'integer|gt:0',
                'size.arithmetic' => [Rule::in(['<', '=', '>', '<=', '>='])],
                'location' => 'string|max:255',
                'numberOfBalconies' => 'array|size:2',
                'numberOfBalconies.value' => 'integer|gt:0',
                'numberOfBalconies.arithmetic' => [Rule::in(['<', '=', '>', '<=', '>='])],
                'balconySize' => 'array|size:2',
                'balconySize.value' => 'integer|gt:0',
                'balconySize.arithmetic' => [Rule::in(['<', '=', '>', '<=', '>='])],
                'orderBy' => 'array',
                'orderBy.*' => 'string|min:2|max:50',
                'created_at' => 'array|size:2',
                'created_at.value' => 'date_format:Y-m-d',
                'created_at.arithmetic' => [Rule::in(['<', '=', '>', '<=', '>='])],
                'page' => 'integer|gt:0',
                'per_page' => 'integer|gt:0'
            ];
        }

        return $returnRules;
    }
}
