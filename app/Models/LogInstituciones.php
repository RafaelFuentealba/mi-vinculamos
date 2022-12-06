<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogInstituciones extends Model {
    use HasFactory;

    protected $table = "log_instituciones";
    public $timestamps = false; /** evita el ingreso de tiempo automáticos */

    /** Los atributos que son asignables en masa. */
    protected $fillable = [
        'inst_codigo',
        'inst_tipo',
        'inst_nombre',
        'inst_direccion',
        'inst_pais',
        'inst_region',
        'inst_provincia',
        'inst_comuna',
        'inst_contacto',
        'inst_url_web',
        'inst_logo',
        'inst_creado',
        'inst_actualizado',
        'inst_vigente',
        'log_codigo',
        'log_institucion_mod',
        'log_usuario_mod',
        'log_fecha_mod'
    ];
}
