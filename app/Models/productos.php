<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    /* The attributes that are mass assignable.
    *
    * @var list<string>
    */
   protected $fillable = [
        'nombre',
        'tipo',
        'descripcion',
        'precio'
   ];

   public function productOrders()
   {
       return $this->hasMany(new_order::class, 'producto_id');
   }
}
