<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recursos extends Model {
    use HasFactory;

    protected $table = "tipo_recursos";
    public $timestamps = false; /** evita el ingreso de tiempo automáticos */

    /** Los atributos que son asignables en masa */
    protected $fillable = [
        'trec_nombre',
        'trec_creado',
        'trec_actualizado',
        'trec_vigente'
    ];
}
