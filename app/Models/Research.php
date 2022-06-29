<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table='research';
    protected $fillable = ['description'];

    public function researchLines() {
        return $this->hasMany(ResearchLine::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
