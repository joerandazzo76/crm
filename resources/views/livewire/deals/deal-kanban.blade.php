<div>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pipeline</h1>
            <p class="mt-1 text-sm text-gray-500">Drag deals between stages.</p>
        </div>
        <div class="flex items-center gap-x-3">
            @if($pipelines->count() > 1)
                <select wire:model.live="pipelineId" class="rounded-lg border-gray-300 text-sm">
                    @foreach($pipelines as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            @endif
            <a href="{{ route('deals.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">List View</a>
            <a href="{{ route('deals.create') }}" class="rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white hover:bg-primary-700">+ Add Deal</a>
        </div>
    </div>

    <div class="mt-6 flex gap-4 overflow-x-auto pb-4" x-data="{
        dragging: null,
        dragOver: null,
        startDrag(e, dealId) {
            this.dragging = dealId;
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', dealId);
        },
        onDragOver(e, stageId) {
            e.preventDefault();
            this.dragOver = stageId;
        },
        onDrop(e, stageId) {
            e.preventDefault();
            const dealId = e.dataTransfer.getData('text/plain');
            this.dragOver = null;
            this.dragging = null;
            $wire.updateDealStage(parseInt(dealId), stageId);
        }
    }">
        @foreach($stages as $stage)
            <div class="flex-shrink-0 w-72"
                 @dragover.prevent="onDragOver($event, {{ $stage->id }})"
                 @dragleave="dragOver = null"
                 @drop="onDrop($event, {{ $stage->id }})">
                <div class="rounded-t-lg px-3 py-2 text-sm font-semibold text-white" style="background-color: {{ $stage->color }}">
                    <div class="flex items-center justify-between">
                        <span>{{ $stage->name }}</span>
                        <span class="rounded-full bg-white/20 px-2 py-0.5 text-xs">{{ $stage->deals->count() }}</span>
                    </div>
                </div>
                <div class="min-h-[200px] rounded-b-lg border-2 border-dashed transition-colors p-2 space-y-2"
                     :class="dragOver === {{ $stage->id }} ? 'border-primary-400 bg-primary-50' : 'border-gray-200 bg-gray-50'">
                    @foreach($stage->deals as $deal)
                        <div draggable="true"
                             @dragstart="startDrag($event, {{ $deal->id }})"
                             :class="dragging == {{ $deal->id }} ? 'opacity-50' : ''"
                             class="cursor-grab rounded-lg bg-white p-3 shadow-sm ring-1 ring-gray-200 hover:shadow transition">
                            <a href="{{ route('deals.show', $deal) }}" class="text-sm font-medium text-gray-900 hover:text-primary-600">{{ $deal->title }}</a>
                            <p class="mt-1 text-xs text-gray-500">{{ $deal->contact?->full_name ?? 'No contact' }}</p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-sm font-semibold text-gray-900">${{ number_format($deal->value, 0) }}</span>
                                @if($deal->owner)
                                    <div class="h-5 w-5 rounded-full bg-primary-100 flex items-center justify-center text-[10px] font-medium text-primary-700" title="{{ $deal->owner->name }}">{{ substr($deal->owner->name, 0, 1) }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
