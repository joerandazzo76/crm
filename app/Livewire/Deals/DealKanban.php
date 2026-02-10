<?php

namespace App\Livewire\Deals;

use App\Models\Deal;
use App\Models\Pipeline;
use App\Models\PipelineStage;
use Livewire\Component;

class DealKanban extends Component
{
    public ?int $pipelineId = null;

    public function mount(): void
    {
        $this->pipelineId = Pipeline::where('is_default', true)->first()?->id
            ?? Pipeline::first()?->id;
    }

    public function updateDealStage(int $dealId, int $stageId): void
    {
        $deal = Deal::findOrFail($dealId);
        $stage = PipelineStage::findOrFail($stageId);

        $deal->update([
            'stage_id' => $stageId,
            'probability' => $stage->win_probability,
        ]);

        // Auto-close deals moved to won/lost stages
        if ($stage->win_probability === 100) {
            $deal->update(['status' => 'won', 'won_at' => now()]);
        } elseif ($stage->win_probability === 0 && $stage->position > 1) {
            $deal->update(['status' => 'lost', 'lost_at' => now()]);
        }
    }

    public function render()
    {
        $pipeline = Pipeline::with(['stages' => function ($q) {
            $q->orderBy('position');
        }])->find($this->pipelineId);

        $stages = $pipeline?->stages?->map(function ($stage) {
            $stage->setRelation('deals', Deal::where('stage_id', $stage->id)
                ->where('status', 'open')
                ->with('contact', 'owner')
                ->latest()
                ->get());
            return $stage;
        }) ?? collect();

        $pipelines = Pipeline::all();

        return view('livewire.deals.deal-kanban', compact('stages', 'pipeline', 'pipelines'))
            ->layout('layouts.app', ['title' => 'Pipeline']);
    }
}
