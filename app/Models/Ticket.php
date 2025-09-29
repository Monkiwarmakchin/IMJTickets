<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;

    const ESTADOS = [
        0 => 'Abierto',
        1 => 'Atendiendo',
        2 => 'Cerrado',
    ];

    public function getEstadoTxtAttribute()
    {
        return self::ESTADOS[$this->estado] ?? 'Desconocido';
    }

    const ESTILOS = [
        0 => 'success',
        1 => 'warning',
        2 => 'error',
    ];

    public function getEstadoStyAttribute()
    {
        return self::ESTILOS[$this->estado] ?? 'Desconocido';
    }

    protected $fillable = [
        "nombre",
        "correo",
        "area",
        "tipo",
        "descripcion",
        "estado"
    ];
}
