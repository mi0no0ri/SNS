<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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

    public function getFollowCount($user_id)
    {
        return $this->where('follow_id',$user_id)->count();
    }
    public function getFollowerCount($user_id)
    {
        return $this->where('follower_id',$user_id)->count();
    }
}
