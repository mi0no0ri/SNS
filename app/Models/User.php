<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'mail',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow_id', 'follower_id');
    }
    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow_id', 'follower_id');
    }
    public function getFollowUsers(Int $user_id)
    {
        return DB::table('follows')->where('follower_id', '=', Auth::id())->get('id');
    }
    public function getFollowerUsers(Int $user_id)
    {
        return DB::table('follows')->where('follow_id', '=', Auth::id())->get('id');
    }
    // follow
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }
    // フォロー解除
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }
    // フォローしてるか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('follow_id', $user_id)->first(['id']);
    }
    // フォローされてるか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('follower_id', $user_id)->first(['id']);
    }

}