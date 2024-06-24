<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = [
        'nombre'
    ];

    // Aquí puedes ocultar los campos timestamps
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function superMercados()
    {
        return $this->hasMany(Supermercado::class, 'ciudad_id');
    }
}
