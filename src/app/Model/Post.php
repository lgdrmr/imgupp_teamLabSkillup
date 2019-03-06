<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['imagefile', 'user_id', 'caption'];

    /**
     * Get users who liked the post
     */
    public function likeUsers()
    {
        return $this->belongsToMany('App\Model\User');
    }
}
