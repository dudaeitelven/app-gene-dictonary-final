<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchLine extends Model
{
    use HasFactory;

    protected $table='research_lines';
    protected $fillable = ['gene', 'organism', 'target_organism', 'target_gene'];

    public function research() {
        return $this->belongsTo(Research::class);
    }
}
