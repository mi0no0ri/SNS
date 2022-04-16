<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->belongsToMany(self::class, 'id', 'follow_id', 'follower_id');
    }
    public function follows()
    {
        return $this->belongsToMany(self::class, 'id', 'follow_id', 'follower_id');
    }
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate();
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
    public function isFollowing($user_id)
    {
        return (boolean) $this->follows()->where('follow_id', $user_id)->first(['id']);
    }
    // フォローされてるか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('follower_id', $user_id)->first(['id']);
    }

}
