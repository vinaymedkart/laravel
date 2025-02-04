<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoleculeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return match ($this->route()->getName()) {
            'createMolecule' => [
                'name' => 'required|string|min:1|max:255|unique:molecules,name',
                'is_active' => 'boolean',
            ],
            'updateMolecule' => [
                'name' => 'required|string|min:1|max:255|unique:molecules,name,' . $this->route('id'),
                'is_active' => 'boolean',
            ],
            default => []
        };
    }

    public function messages()
    {
        return [
            'name.required' => 'Molecule name is required',
            'name.unique' => 'Molecule name must be unique',
        ];
    }
}
