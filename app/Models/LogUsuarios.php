<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUsuarios extends Model {
    use HasFactory;

    protected $table = "log_usuarios_vinculamos";
    public $timestamps = false; /** evita el ingreso de tiempo automáticos */

    /** Los atributos que son asignables en masa */
    protected $fillable = [
        'inst_codigo',
        'usvi_codigo',
        'usvi_permisos',
        'usvi_superadmin',
        'usvi_nombre',
        'usvi_apellido',
        'usvi_email',
        'usvi_telefono',
        'usvi_clave',
        'usvi_nacimiento',
        'usvi_direccion',
        'usvi_comuna',
        'usvi_provincia',
        'usvi_region',
        'usvi_pais',
        'usvi_foto',
        'usvi_profesion',
        'usvi_ocupacion',
        'usvi_presentacion',
        'usvi_intereses',
        'usvi_habilidades',
        'usvi_vins',
        'usvi_creado',
        'usvi_actualizado',
        'usvi_vigente',
        'log_codigo',
        'log_institucion_mod',
        'log_usuario_mod',
        'log_fecha_mod'
    ];
}
