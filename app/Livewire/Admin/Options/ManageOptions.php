<?php

namespace App\Livewire\Admin\Options;

use App\Livewire\Forms\Admin\Options\NewOptionForm;
use App\Models\Feature;
use App\Models\Option;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageOptions extends Component
{

    public $options;
    public NewOptionForm $newOption;

    public function mount()
    {
        $this->options = Option::with('feature')->get();
    }

    #[On('featureAdded')]
    public function updateOptionList()
    {
        $this->options = Option::with('feature')->get();
    }

    public function addFeature()
    {
        $this->newOption->addFeature();
    }

    public function removeFeature($index)
    {
        $this->newOption->removeFeature($index);
    }

    public function deleteFeature(Feature $featureId)
    {
        $featureId->delete();
        $this->options = Option::with('feature')->get();

    }

    public function deleteOption(Option $option)
    {
        $option->delete();
        $this->options = Option::with('feature')->get();

    }

    public function saveOption()
    {

        $this->newOption->save(); 
        $this->options = Option::with('feature')->get();

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Opción creada',
            'text' => 'La opción ha sido creada correctamente.',
            
        ]);
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
