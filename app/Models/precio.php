<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class precio extends Model
{   
   protected $fillable = [
       'id',
       'nombre',
       'descuentos',
   ];
}
