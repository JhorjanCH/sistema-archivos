<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $table = 'archivos'; // Nombre explícito de la tabla
    protected $fillable = ['nombre', 'estado_archivo', 'carpeta_id', 'borrado']; // Declaración completa de columnas para asignación masiva

    public function carpeta()
    {
        return $this->belongsTo(Carpeta::class); // Relación con la tabla carpetas
    }
}
