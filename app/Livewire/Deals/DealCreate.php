<?php

namespace App\Livewire\Deals;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\Pipeline;
use Livewire\Component;

class DealCreate extends Component
{
    public ?Deal $deal = null;
    public string $title = '';
    public string $value = '0';
    public string $currency = 'USD';
    public ?int $pipeline_id = null;
    public ?int $stage_id = null;
    public ?int $contact_id = null;
    public ?int $company_id = null;
    public ?string $expected_close_date = null;
    public int $probability = 0;

    public function mount(?Deal $deal = null): void
    {
        $defaultPipeline = Pipeline::where('is_default', true)->first() ?? Pipeline::first();
        $this->pipeline_id = $defaultPipeline?->id;
        $this->stage_id = $defaultPipeline?->stages()->orderBy('position')->first()?->id;

        if ($deal?->exists) {
            $this->deal = $deal;
            $this->fill($deal->only(['title', 'value', 'currency', 'pipeline_id', 'stage_id', 'contact_id', 'company_id', 'probability']));
            $this->expected_close_date = $deal->expected_close_date?->format('Y-m-d');
        }
    }

    public function updatedPipelineId(): void
    {
        $this->stage_id = Pipeline::find($this->pipeline_id)?->stages()->orderBy('position')->first()?->id;
    }

    public function save()
    {
        $data = $this->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'pipeline_id' => 'required|exists:pipelines,id',
            'stage_id' => 'required|exists:pipeline_stages,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'company_id' => 'nullable|exists:companies,id',
            'expected_close_date' => 'nullable|date',
            'probability' => 'integer|min:0|max:100',
        ]);

        $data['owner_id'] = auth()->id();

        if ($this->deal) {
            $this->deal->update($data);
            return redirect()->route('deals.show', $this->deal)->with('success', 'Deal updated.');
        }

        $deal = Deal::create($data);
        return redirect()->route('deals.show', $deal)->with('success', 'Deal created.');
    }

    public function render()
    {
        $pipelines = Pipeline::with('stages')->get();
        $stages = $this->pipeline_id ? Pipeline::find($this->pipeline_id)?->stages()->orderBy('position')->get() : collect();

        return view('livewire.deals.deal-create', [
            'pipelines' => $pipelines,
            'stages' => $stages,
            'contacts' => Contact::orderBy('first_name')->get(),
            'companies' => Company::orderBy('name')->get(),
            'isEdit' => (bool) $this->deal,
        ])->layout('layouts.app', ['title' => $this->deal ? 'Edit Deal' : 'New Deal']);
    }
}
