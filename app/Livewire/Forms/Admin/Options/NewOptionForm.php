<?php

namespace App\Livewire\Forms\Admin\Options;

use App\Models\Option;
use Livewire\Attributes\Rule;
use Livewire\Form;

class NewOptionForm extends Form
{
    public $name;
    public $type = 1;
    public $features = [
        [
            'value' => '',
            'description' => ''
        ]
    ];

    public $openModal = false;

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'type' => 'required|in:1,2',
            'features' => 'required|array|min:1',
        ];

        foreach ($this->features as $index => $feature) {

            if ($this->type == 1) {
                //Texto
                $rules['features.' . $index . '.value'] = 'required';
            } else {
                //Color
                $rules['features.' . $index . '.value'] = 'required|regex:/^#[0-9A-Fa-f]{6}$/';
            }

            $rules['features.' . $index . '.description'] = 'required|string|max:255';
        }

        return $rules;        
    }

    public function validationAtrributes()
    {
        $atrributes = [
            'name' => 'nombre',
            'type' => 'tipo',
            'features' => 'valores',
        ];

        foreach ($this->features as $index => $feature) {
            $atrributes['features.' . $index . '.value'] = 'valor ' . ($index + 1);
            $atrributes['features.' . $index . '.description'] = 'descripción ' . ($index + 1);
        }

        return $atrributes;
    }

    public function addFeature()
    {
        $this->features[] = [
            'value' => '',
            'description' => ''
        ];
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function save()
    {
        $this->validate();

        $option = Option::create([
            'name' => $this->name,
            'type' => $this->type,
        ]);

        foreach ($this->features as $feature) {
            $option->feature()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],
            ]);
        }
        $this->reset();
    }
}
