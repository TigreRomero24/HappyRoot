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
       'id',
       'nombre',
       'tipo',
       'descripcion',
       'precio',
   ];
}
