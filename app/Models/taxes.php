<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxes extends Model
{
    /* The attributes that are mass assignable.
    *
    * @var list<string>
    */
   protected $fillable = [
        'destino',
        'tipo',
        'taxes',
        'intercom',
        'profit',
        'total'
   ];

   public function orders()
   {
       return $this->hasMany(Order::class, 'taxes_id');
   }
}