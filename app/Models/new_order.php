<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class new_order extends Model
{
    protected $fillable = [
        'destino',
        'address',
        'producto_id',
        'usuario_id',
        'taxes_id',
        'total'
    ];

    public function productOrders()
    {
        return $this->belongsTo(producto::class,'producto_id');
    }

    public function userOrders()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }

    public function taxesOrders()
    {
        return $this->belongsTo(taxes::class,'taxes_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(order::class, 'new_order_id');
    }
}
