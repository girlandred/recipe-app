<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreRecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'servings' => 'required',
            'directions' => 'required',
            'timing' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            'category_id' => 'exists:App\Models\Category,id',
            'ingredients' => 'required|array',
            'specifications' => 'array|nullable',
            'specifications.*' => 'exists:specifications,id',
        ];
    }

    public function specifications(): array
    {
        return $this->get('specifications', []);
    }
}
