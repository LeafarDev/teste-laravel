<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    public $protected = [];


    public function rules()
    {
        $rules = [
            'name' => 'required',
            'year' => 'required|integer',
            'model' => 'required',
        ];

        if (request()->isMethod('PUT')) {
            return array_merge($rules, [
                'id' => ['required', 'exists:mysql.cars,id', function ($attribute, $value, $fail) {
                    if ($this->getUlrIdValue() !== $this->input('id')) {
                        $fail('Invalid id');
                        return false;
                    }
                }]
            ]);
        }
        return $rules;
    }

    public function getUlrIdValue()
    {
        return (int)$this->route()->parameters[key($this->route()->parameters())];
    }
}
