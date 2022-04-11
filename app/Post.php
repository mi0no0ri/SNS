<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    // add
    protected $guarded = array('id');

        public static $rules = array(
            'post_content' => 'required',
    );
    // add
    public function getDate()
    {
        return $this->id . ': ' . $this->post_content . '('
            . $this->users->username . ')';
    }
}
