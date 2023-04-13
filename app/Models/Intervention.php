<?php

namespace App\Models;

use App\Models\Technicien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Intervention extends Model
{
    use HasFactory;

    public function techniciens(){
        return $this->belongsToMany(Technicien::class)->withPivot('date');
    }
}
