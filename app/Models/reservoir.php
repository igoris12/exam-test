<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservoir extends Model
{
    use HasFactory;




     public function getMember()
   {
       return $this->hasMany('App\Models\Member', 'reservoir_id', 'id');
   }
}
