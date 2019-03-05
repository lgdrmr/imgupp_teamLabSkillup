<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = ['imagefile', 'user_id', 'caption'];
}
