<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Table;

class Supermercado extends Model
{
    use HasFactory;
    protected $table = 'Supermercado';

    protected $fillable = [
        'nombre',
        'NIT',
        'direccion',
        'logo',
        'latitud',
        'longitud',
        'ciudad_id'
    ];

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }
}
