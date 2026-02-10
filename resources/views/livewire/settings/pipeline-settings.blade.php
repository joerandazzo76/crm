<div>
    <h1 class="text-2xl font-bold text-gray-900">Settings</h1>

    <x-settings-tabs active="pipeline" />

    <div class="mt-6 max-w-2xl space-y-6">
        {{-- Add Pipeline --}}
        <form wire:submit="createPipeline" class="flex gap-x-3">
            <input wire:model="newPipelineName" type="text" placeholder="New pipeline name..." class="flex-1 rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
            <button type="submit" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">Add Pipeline</button>
        </form>

        @foreach($pipelines as $pipeline)
            <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h2 class="text-sm font-semibold text-gray-900">{{ $pipeline->name }} @if($pipeline->is_default)<span class="text-xs text-gray-400">(Default)</span>@endif</h2>
                    @unless($pipeline->is_default)
                        <button wire:click="deletePipeline({{ $pipeline->id }})" wire:confirm="Delete this pipeline and all its stages?" class="text-sm text-red-600 hover:text-red-700">Delete</button>
                    @endunless
                </div>

                <div class="p-6 space-y-2">
                    @foreach($pipeline->stages as $stage)
                        <div class="flex items-center justify-between rounded-lg bg-gray-50 px-4 py-2">
                            <div class="flex items-center gap-x-3">
                                <span class="h-3 w-3 rounded-full" style="background-color: {{ $stage->color }}"></span>
                                <span class="text-sm text-gray-900">{{ $stage->name }}</span>
                                <span class="text-xs text-gray-400">{{ $stage->win_probability }}% probability</span>
                            </div>
                            <button wire:click="deleteStage({{ $stage->id }})" wire:confirm="Delete this stage?" class="text-gray-400 hover:text-red-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                    @endforeach

                    <form wire:submit="addStage({{ $pipeline->id }})" class="flex items-center gap-x-2 mt-3">
                        <input wire:model="newStageName" type="text" placeholder="Stage name..." class="flex-1 rounded-lg border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                        <input wire:model="newStageColor" type="color" class="h-9 w-9 rounded-lg border-gray-300 cursor-pointer">
                        <button type="submit" class="rounded-lg border border-gray-300 px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Add Stage</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
