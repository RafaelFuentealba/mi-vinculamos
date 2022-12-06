<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogVins extends Model {
    use HasFactory;

    protected $table = "log_puntuacion_vins";
    public $timestamps = false; /** evita el ingreso de tiempo automáticos */

    /** Los atributos que son asignables en masa */
    protected $fillable = [
        'pvin_codigo',
        'pvin_nombre',
        'pvin_tabla_referencia',
        'pvin_tabla_descripcion',
        'pvin_cantidad',
        'pvin_creado',
        'pvin_actualizado',
        'pvin_vigente',
        'log_codigo',
        'log_institucion_mod',
        'log_usuario_mod',
        'log_fecha_mod'
    ];
}
