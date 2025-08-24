<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = [
        'Shipment_id',
        'destino',
        'address',
        'producto_id',
        'usuario_id',
        'taxes_id',
        'origen',
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

    public function product()
    {
        return $this->belongsTo(Producto::class,'producto_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function taxes()
    {
        return $this->belongsTo(Taxes::class,'taxes_id');
    }

}