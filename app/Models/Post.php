<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    protected $fillable = [
        'text'
    ];
    protected $guarded = array('id');

        public static $rules = array(
            'post_content' => 'required',
    );
    public function getDate()
    {
        return $this->id . ': ' . $this->post_content . '('
            . $this->users->username . ')';
    }
}
