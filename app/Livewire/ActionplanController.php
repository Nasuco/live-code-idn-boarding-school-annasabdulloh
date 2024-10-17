<?php

namespace App\Livewire;

use App\Models\ActionPlan;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ActionplanController extends Component
{
    #[Layout('layouts.app')]
    public $agenda = '';
    public $priority = '';
    public $agendas = [];
    public $editId = null;
    public $editAgenda = '';
    public $editPriority = '';
    public $deleteId = null;

    public function mount()
    {
        $this->loadAgendas();
    }

    public function loadAgendas()
    {
        $this->agendas = ActionPlan::orderBy('created_at', 'desc')->get()->toArray();
    }

    public function save()
    {
        $this->validate([
            'agenda' => 'required|string|max:255',
            'priority' => 'required|in:high,medium,low',
        ]);

        ActionPlan::create([
            'agenda' => $this->agenda,
            'priority' => $this->priority,
        ]);

        $this->agenda = '';
        $this->priority = '';

        $this->loadAgendas();

        session()->flash('status', 'Agenda berhasil dibuat!');
    }

    public function edit($id)
    {
        $agenda = ActionPlan::findOrFail($id);
        $this->editId = $id;
        $this->editAgenda = $agenda->agenda;
        $this->editPriority = $agenda->priority;
    }

    public function update()
    {
        $this->validate([
            'editAgenda' => 'required|string|max:255',
            'editPriority' => 'required|in:high,medium,low',
        ]);

        $agenda = ActionPlan::findOrFail($this->editId);
        $agenda->update([
            'agenda' => $this->editAgenda,
            'priority' => $this->editPriority,
        ]);

        $this->editId = null;
        $this->editAgenda = '';
        $this->editPriority = '';

        $this->loadAgendas();

        session()->flash('status', 'Agenda berhasil diperbarui!');
    }

    public function cancelEdit()
    {
        $this->editId = null;
        $this->editAgenda = '';
        $this->editPriority = '';
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {
        if ($this->deleteId) {
            ActionPlan::destroy($this->deleteId);
            $this->deleteId = null;
            $this->loadAgendas();

            session()->flash('status', 'Agenda berhasil dihapus!');
        }
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
    }

    public function toggleCompleted($id)
    {
        $agenda = ActionPlan::find($id);
        if ($agenda) {
            $agenda->completed = $agenda->completed ? 0 : 1;
            $agenda->save();
        }

        session()->flash('status', 'Agenda berhasil diperbarui!');
        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.actionplan-controller');
    }
}