<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'Shipment_id',
        'new_order_id',
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


    public function user(){
        return $this->belongsTo(new_order::class, 'new_order_id');
    }
}