<?php

namespace App\Http\Livewire;

use App\Models\Research;
use App\Models\ResearchLine;
use Livewire\Component;

class ResearchesShowDetail extends Component
{
    public $research;
    protected $researchLines;


    public function mount($id){
        $this->research = Research::find($id);
        $this->researchLines = ResearchLine::where('research_id', $this->research->id)->get();
    }

    public function render()
    {
        return view('livewire.researches-show-detail', [
            'researchLines' => $this->researchLines,
            'research' => $this->research
        ]);
    }
}
