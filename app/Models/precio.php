<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    protected $table = 'precios';
    
    protected $fillable = [
        'nombre',
        'descuentos'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'wholesPrice_id');
    }
}
