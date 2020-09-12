<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
        $model = $this->model();

        return [
            'user_id' => [
                'required',
                Rule::exists('users', 'id'),
            ],
            'title' => [
                'required',
                Rule::unique('posts', 'title')->ignore(
                    $model && $model->exists ? $model->id : null
                ),
            ],
        ];
    }

    /**
     * Get the pretty name of attributes.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'user_id' => 'user',
        ];
    }

    /**
     * Get the model by extracting it from route binding.
     *
     * @return \Illuminate\Routing\Route|object|string|null
     */
    protected function model()
    {
        return $this->route('post') ?: null;
    }
}