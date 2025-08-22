<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class taxes extends Model
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

   public function taxesOrders()
   {
       return $this->hasMany(new_order::class, 'taxes_id');
   }
}