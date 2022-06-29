<?php

namespace App\Exports;

use App\Models\Research;
use App\Models\ResearchLine;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ResearchExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct(int $id)
    {
        $this->researchID = $id;
    }

    public function headings(): array
    {
        return [
            'Gene',
            'Organism',
            'Target_Organism',
            'Target_Gene',
            'Created_at',
        ];
    }

    public function map($line): array
    {
        return [
            $line->gene,
            $line->organism,
            $line->target_organism,
            $line->target_gene,
            $line->created_at->format('d/m/Y'),
        ];
    }

    public function query()
    {
        return ResearchLine::where('research_id', $this->researchID);;
    }
}
