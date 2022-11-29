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
    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }


    // favorite
    public function favorites()
    {
        return $this->belongsToMany('App\Models\Post', 'favorites', 'user_id', 'post_id')->withTimestamps();
    }

    public function isFavorite($post)
    {
        return $this->favorites()->where('post_id', $post)->exists();
    }

    public function favorite($post)
    {
        if($this->isFavorite($post)){
        } else {
            return $this->favorites()->attach($post);
        }
    }

    public function unfavorite($post)
    {
        if($this->isFavorite($post)){
            return $this->favorites()->detach($post);
        } else {
        }
    }


    // follow
    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'follow_id');
    }
    public function getFollowUsers(Int $id)
    {
        return DB::table('follows')->where('follower_id', '=', Auth::id())->get('id');
    }
    // フォロー
    public function follow(Int $id)
    {
        return $this->follows()->attach($id);
    }
    // フォロー解除
    public function unfollow(Int $id)
    {
        return $this->follows()->detach($id);
    }
    // フォローしてるか
    public function isFollowing(Int $id)
    {
        return $this->follows()->where('follow_id', $id)->first(['follower_id']);
    }
}
