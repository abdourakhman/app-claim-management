<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Client;
use App\Models\Technicien;
use App\Models\Gestionnaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reclamation extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function gestionnaire(){
        return $this->belongsTo(Gestionnaire::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function techniciens(){
        return $this->belongsToMany(Technicien::class)->withPivot('date');
    }
}
