<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /* The attributes that are mass assignable.
    *
    * @var list<string>
    */
   protected $fillable = [
        'nombre',
        'descripcion',
        'precio_pallets',
        'precio_boxes'
   ];

   public function orders()
   {
       return $this->hasMany(Order::class, 'producto_id');
   }
}
