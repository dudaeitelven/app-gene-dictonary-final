<?php

namespace App\Http\Livewire;

use App\Models\Research;
use App\Models\ResearchLine;

use Livewire\Component;

class Researches extends Component
{
    public $description;
    public $researchLines = [];

    public function mount()
    {
        $this->researchLines = [
            [
                'gene' => '',
                'organism' => '',
                'target_organism' => ''
            ]
        ];
    }

    public function addLine()
    {
        $this->researchLines[] = [
            'gene' => '',
            'organism' => '',
            'target_organism' => ''
        ];
    }

    public function removeLine($index)
    {
        unset($this->researchLines[$index]);
        $this->researchLines = array_values($this->researchLines);
    }

    public function storeResearch()
    {
        $this->validate([
            'description' =>'required',
        ]);

        $research=new Research();
        $research->description = $this->description;
        $research->save();

        $user = auth()->user();
        $user->researches()->attach($research->id);

        foreach ($this->researchLines as $line)
        {
            $scraping_path = "C:\LaravelProjects\app-gene-dictionary\public\js\Scraping\index.js";

            $command = (
                "node "
                . $scraping_path
                . " "
                . escapeshellarg($line['gene'])
                . " "
                . escapeshellarg($line['organism'])
                . " "
                . escapeshellarg($line['target_organism'])
            );

            set_time_limit(60); //Time limit increased because of the web scraping.

            $result = shell_exec($command);

            if(empty($result))
            {
                $result = "Not found";
            }
            else
            {
                $result = str_replace(", ,",", ",$result);
            }

            $researchLines=new ResearchLine();
            $researchLines->research_id = $research->id;
            $researchLines->gene = $line['gene'];
            $researchLines->organism = $line['organism'];
            $researchLines->target_organism = $line['target_organism'];
            $researchLines->target_gene = $result;
            $researchLines->save();
        }

        $research->researchLines = [];
        $this->reset();

        return redirect()->route('researches-tab-detail',['id' => $research->id]);
    }

    public function render()
    {
        info($this->researchLines);
        return view('livewire.researches');
    }
}
