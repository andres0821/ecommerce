<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductVariants extends Component
{

    public $product;
    public $openModal = false;
    public $options;

    public $variant = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'description' => ''
            ]
        ]
    ];

    public function mount()
    {
        $this->options = Option::all();
    }

    public function updatedVariantOptionId()
    {
        // Reset features when option_id changes 
        $this->variant['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => ''
            ]
        ];
    }

    # This method is called when the component is initialized
    #[Computed()]
    public function features()
    {
        return Feature::where('option_id', $this->variant['option_id'])->get();
    }

    public function addFeature()
    {
        $this->variant['features'][] = [
            'id' => '',
            'value' => '',
            'description' => ''
        ];
    }

    public function feature_change($index)
    {
        $feature = Feature::find($this->variant['features'][$index]['id']);

        if ($feature) {
            $this->variant['features'][$index]['value'] = $feature->value;
            $this->variant['features'][$index]['description'] = $feature->description;
        } else {
            $this->variant['features'][$index]['value'] = '';           
            $this->variant['features'][$index]['description'] = '';
        }
    }

    public function removeFeature($index)
    {
        unset($this->variant['features'][$index]);
        $this->variant['features'] = array_values($this->variant['features']);
    }

    public function deleteFeature($option_id, $feature_id)
    {
        $this->product->options()->updateExistingPivot($option_id, [
            'features' => array_filter($this->product->options()->find($option_id)->features, function ($feature) use ($feature_id) {
                return $feature['id'] !== $feature_id;
            })
        ]);
    }
        

    public function save()
    {
        $this->validate([
            'variant.option_id' => 'required|exists:options,id',
            'variant.features.*.id' => 'required|exists:features,id',
            'variant.features.*.value' => 'required|string|max:255',
            'variant.features.*.description' => 'nullable|string|max:500',
        ],[],[
            'variant.option_id' => 'Opción',
            'variant.features.*.id' => 'Valor',
            'variant.features.*.value' => 'Característica',
            'variant.features.*.description' => 'Descripción',
        ]);
        // Here you would typically save the variant to the database

        $this->product->options()->attach($this->variant['option_id'], [
            'features' => $this->variant['features']
        ]);
        $this->reset(['variant', 'openModal']);
    }

    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
