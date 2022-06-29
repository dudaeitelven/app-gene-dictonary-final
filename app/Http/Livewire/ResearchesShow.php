<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Research;
use App\Models\User;
use App\Exports\ResearchExport;
use Maatwebsite\Excel\Facades\Excel;

class ResearchesShow extends Component
{
    use WithPagination;

    public $researchToDelete = false;
    public $researchToShare = false;
    public $researchIDToShare= NULL;
    public $userIDToShare = NULL;
    public $users = [];


    public function exportResearch($id)
    {
        $file_name = 'Research_' . $id . '_' . time() .'.xlsx';

        return Excel::download(new ResearchExport($id), $file_name);
    }

    public function researchToShare($id)
    {
        $this->resetErrorBag();

        $this->researchIDToShare = Research::findOrFail($id);

        $this->users = User::whereDoesntHave('researches', function ($query) {
            $query->where('id', '=', $this->researchIDToShare->id);
        })->get();

        $this->researchToShare = true;
    }

    public function saveResearchShare()
    {
        $user = User::findOrFail($this->userIDToShare);
        $user->researches()->attach($this->researchIDToShare->id);

        $this->researchToShare = false;
    }

    public function researchToDelete($id)
    {
        $this->researchToDelete = $id;
    }

    public function deleteResearch($id)
    {
        $user = auth()->user();
        $user->researches()->detach($id);

        $this->researchToDelete = false;
    }

    public function updatingActive()
    {
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = auth()->user();
        $researches = $user->researches();

        return view('livewire.researches-show', [
            'Researches' =>$researches->orderBy('created_at', 'DESC')->paginate(5),
            'Users' =>$this->users,
        ]);
    }
}
