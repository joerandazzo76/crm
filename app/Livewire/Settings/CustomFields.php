<?php

namespace App\Livewire\Settings;

use App\Models\CustomField;
use Livewire\Component;

class CustomFields extends Component
{
    public string $module = 'contacts';
    public string $fieldLabel = '';
    public string $fieldType = 'text';
    public string $fieldOptions = '';
    public bool $fieldRequired = false;
    public bool $showAddModal = false;

    public function addField(): void
    {
        $this->validate([
            'fieldLabel' => 'required|string|max:255',
            'fieldType' => 'required|in:text,number,date,select,textarea,checkbox',
        ]);

        $name = str()->slug($this->fieldLabel, '_');

        $options = null;
        if ($this->fieldType === 'select' && $this->fieldOptions) {
            $options = array_map('trim', explode(',', $this->fieldOptions));
        }

        CustomField::create([
            'module' => $this->module,
            'name' => $name,
            'label' => $this->fieldLabel,
            'type' => $this->fieldType,
            'options' => $options,
            'required' => $this->fieldRequired,
            'sort_order' => CustomField::where('module', $this->module)->count(),
        ]);

        $this->reset('fieldLabel', 'fieldType', 'fieldOptions', 'fieldRequired', 'showAddModal');
        session()->flash('success', 'Custom field added.');
    }

    public function deleteField(int $id): void
    {
        CustomField::findOrFail($id)->delete();
        session()->flash('success', 'Custom field deleted.');
    }

    public function render()
    {
        $fields = CustomField::where('module', $this->module)
            ->orderBy('sort_order')
            ->get();

        return view('livewire.settings.custom-fields', compact('fields'))
            ->layout('layouts.app', ['title' => 'Custom Fields']);
    }
}
