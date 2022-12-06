<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vins extends Model {
    use HasFactory;

    protected $table = "puntuacion_vins";
    public $timestamps = false; /** evita el ingreso de tiempo automáticos */

    /** Los atributos que son asignables en masa */
    protected $fillable = [
        'pvin_nombre',
        'pvin_tabla_referencia',
        'pvin_tabla_descripcion',
        'pvin_cantidad',
        'pvin_creado',
        'pvin_actualizado',
        'pvin_vigente'
    ];
}
