<?php

namespace App\Livewire\Settings;

use App\Models\Pipeline;
use App\Models\PipelineStage;
use Livewire\Component;

class PipelineSettings extends Component
{
    public ?int $editingPipelineId = null;
    public string $newPipelineName = '';
    public string $newStageName = '';
    public string $newStageColor = '#6366f1';

    public function createPipeline(): void
    {
        $this->validate(['newPipelineName' => 'required|string|max:255']);
        Pipeline::create(['name' => $this->newPipelineName]);
        $this->newPipelineName = '';
    }

    public function addStage(int $pipelineId): void
    {
        $this->validate(['newStageName' => 'required|string|max:255']);
        $maxPosition = PipelineStage::where('pipeline_id', $pipelineId)->max('position') ?? 0;
        PipelineStage::create([
            'pipeline_id' => $pipelineId,
            'name' => $this->newStageName,
            'color' => $this->newStageColor,
            'position' => $maxPosition + 1,
        ]);
        $this->reset(['newStageName', 'newStageColor']);
    }

    public function deleteStage(int $stageId): void
    {
        PipelineStage::findOrFail($stageId)->delete();
    }

    public function deletePipeline(int $pipelineId): void
    {
        Pipeline::findOrFail($pipelineId)->delete();
    }

    public function render()
    {
        return view('livewire.settings.pipeline-settings', [
            'pipelines' => Pipeline::with(['stages' => fn ($q) => $q->orderBy('position')])->get(),
        ])->layout('layouts.app', ['title' => 'Pipeline Settings']);
    }
}
