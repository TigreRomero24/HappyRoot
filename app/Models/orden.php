<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class orden extends Model
{
    protected $table = 'orden';

    protected $fillable = [
        'Shipment_id',
        'usuario_id',
        'origen',
        'destino',
        'container',
        'fechaSalida',
        'fechaLlegada',
        'estado',
        'total'
    ];
    protected $casts = [
        'fechaSalida' => 'date',
        'fechaLlegada' => 'date',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}