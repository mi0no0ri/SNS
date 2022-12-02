<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}
