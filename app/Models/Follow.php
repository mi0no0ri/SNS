<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $primaryKey = [
        'follow_id',
        'follower_id'
    ];
    protected $fillable = [
        'follow_id',
        'follower_id'
    ];
    public $timestamp = false;
    public $incrementing = false;
}
