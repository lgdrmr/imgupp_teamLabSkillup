<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['github_id', 'avaterfile'];

    /**
     * Get posts which the user liked
     */
    public function likePosts()
    {
        return $this->belongsToMany('App\Model\Post');
    }
}
