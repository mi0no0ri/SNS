<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Auth;

class Post extends Model
{
    protected $fillable = [
        'post',
        'user_id',
        'created_at',
        'update_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getDate()
    {
        return $this->id . ': ' . $this->post_content . '('
            . $this->users->username . ')';
    }

}
