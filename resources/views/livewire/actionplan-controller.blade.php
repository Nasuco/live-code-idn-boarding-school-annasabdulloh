<div>
    <div class="container mt-4 text-center">
        <h1 class="fw-bold">My Action Plan</h1>
        <p>Keep yourself organized and be productive</p>

        @if (session()->has('status'))
            <div class="alert alert-success col-md-5 col-12 mx-auto text-center">
                {{ session('status') }}
            </div>
        @endif

        
        <div class="mb-3">
            <div class="row justify-content-center">
                <div class="col-md-4 col-12 mb-2">
                    <input type="text" class="form-control" placeholder="Tulis agenda anda disini..." wire:model="agenda">
                </div>
                <div class="col-md-1 col-12 mb-2 d-flex justify-content-md-end">
                    <button class="btn btn-success w-100" wire:click="save" :disabled="!$wire.agenda || !$wire.priority">
                        Tambah
                    </button>
                </div>
                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-center">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="priority" id="priorityHigh" value="high" wire:model="priority">
                            <label class="form-check-label" for="priorityHigh">High Priority</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="priority" id="priorityMedium" value="medium" wire:model="priority">
                            <label class="form-check-label" for="priorityMedium">Medium Priority</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="priority" id="priorityLow" value="low" wire:model="priority">
                            <label class="form-check-label" for="priorityLow">Low Priority</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="overflow-auto" style="max-height: 495px;">
                @php
                    $nonCompletedAgendas = array_filter($agendas, fn($agenda) => !$agenda['completed']);
                    $completedAgendas = array_filter($agendas, fn($agenda) => $agenda['completed']);
                @endphp
        
                @if(empty($agendas))
                    <p class="text-muted">Belum ada agenda, silahkan tambah terlebih dahulu..</p>
                @else
                    @if(!empty($nonCompletedAgendas))
                        @foreach($nonCompletedAgendas as $agenda)
                            <div class="mb-4">
                                <div class="card shadow-sm border rounded mx-auto" style="width: 100%; max-width: 525px;">
                                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-flex-start flex-wrap">
                                        <div class="d-flex align-items-center mb-2 mb-md-0 w-100">
                                            <input type="checkbox" class="form-check-input me-3" wire:click="toggleCompleted({{ $agenda['id'] }})" @if($agenda['completed']) checked @endif>
                                            <div class="d-flex flex-column">
                                                <span class="mb-2">
                                                    @if($agenda['priority'] === 'high')
                                                        <span class="badge text-bg-danger">High</span>
                                                    @elseif($agenda['priority'] === 'medium')
                                                        <span class="badge text-bg-primary">Medium</span>
                                                    @elseif($agenda['priority'] === 'low')
                                                        <span class="badge text-bg-warning">Low</span>
                                                    @else
                                                        <span class="badge text-bg-secondary">Unknown</span>
                                                    @endif
                                                </span>
                                                <span class="d-inline-block text-wrap" style="max-width: 100%; word-break: break-all;">
                                                    {{ $agenda['agenda'] }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-md-row align-items-center w-100">
                                            @if($editId === $agenda['id'])
                                                <div class="d-flex flex-column flex-md-row align-items-center w-100">
                                                    <div class="me-2 mb-2 mb-md-0 w-100">
                                                        <input type="text" class="form-control" wire:model="editAgenda" wire:keydown.enter="update" placeholder="Edit agenda...">
                                                    </div>
                                                    <div class="me-2 mb-2 mb-md-0 w-100">
                                                        <select class="form-select" wire:model="editPriority" wire:keydown.enter="update">
                                                            <option value="high">High Priority</option>
                                                            <option value="medium">Medium Priority</option>
                                                            <option value="low">Low Priority</option>
                                                        </select>
                                                    </div>
                                                    <span wire:click="cancelEdit" style="cursor: pointer;">
                                                        <x-cancel /> 
                                                    </span>
                                                </div>
                                            @else
                                                <div class="position-absolute" style="top: 10px; right: 10px;">
                                                    <span wire:click="edit({{ $agenda['id'] }})" style="cursor: pointer;" class="me-2">
                                                        <x-edit /> 
                                                    </span>
                                                    <span wire:click="confirmDelete({{ $agenda['id'] }})" style="cursor: pointer;">
                                                        <x-delete /> 
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
        
                    @if(!empty($completedAgendas))
                        <div class="mb-4 mt-5">
                            <h5 class="text-muted">Agenda Selesai</h5>
                        </div>
                        @foreach($completedAgendas as $agenda)
                            <div class="mb-4">
                                <div class="card shadow-sm border rounded mx-auto" style="width: 100%; max-width: 525px;">
                                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-flex-start flex-wrap">
                                        <div class="d-flex align-items-center mb-2 mb-md-0 w-100">
                                            <input type="checkbox" class="form-check-input me-3" wire:click="toggleCompleted({{ $agenda['id'] }})" @if($agenda['completed']) checked @endif>
                                            <div class="d-flex flex-column">
                                                <span class="mb-2">
                                                    <span class="badge text-bg-success">Selesai</span>
                                                </span>
                                                <span class="d-inline-block text-wrap" style="max-width: 100%; word-break: break-all;">
                                                    {{ $agenda['agenda'] }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column flex-md-row align-items-center w-100">
                                            @if($editId === $agenda['id'])
                                                <div class="d-flex flex-column flex-md-row align-items-center w-100">
                                                    <div class="me-2 mb-2 mb-md-0 w-100">
                                                        <input type="text" class="form-control" wire:model="editAgenda" wire:keydown.enter="update" placeholder="Edit agenda...">
                                                    </div>
                                                    <div class="me-2 mb-2 mb-md-0 w-100">
                                                        <select class="form-select" wire:model="editPriority" wire:keydown.enter="update">
                                                            <option value="high">High Priority</option>
                                                            <option value="medium">Medium Priority</option>
                                                            <option value="low">Low Priority</option>
                                                        </select>
                                                    </div>
                                                    <span wire:click="cancelEdit" style="cursor: pointer;">
                                                        <x-cancel /> 
                                                    </span>
                                                </div>
                                            @else
                                                <div class="position-absolute" style="top: 10px; right: 10px;">
                                                    <span wire:click="edit({{ $agenda['id'] }})" style="cursor: pointer;" class="me-2">
                                                        <x-edit /> 
                                                    </span>
                                                    <span wire:click="confirmDelete({{ $agenda['id'] }})" style="cursor: pointer;">
                                                        <x-delete /> 
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>

    @if($deleteId)
        <x-delete-modal :deleteId="$deleteId" />
    @endif
</div>
