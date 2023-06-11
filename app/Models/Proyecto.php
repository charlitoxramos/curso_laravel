<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{

    protected $table = 'proyectos';
    protected $primaryKey = 'id';

    protected $fillable=[
        'nombre',
        'fuente',
        'planificado',
        'patrocinado',
        'propios',
    ];

    protected $guarded = [];

    public $timestamps = false;

    
}
