<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuidad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    public function superMercados()
    {
        return $this->hasMany(Supermercado::class, 'ciudad_id');
    }
}
