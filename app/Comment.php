<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'blog_post_id', 'parent_id', 'body',
    ];

    /**
     * Get associated blog post
     * @return collection
     */

    public function post()
    {
        return $this->belongsTo('App\BlogPost');
    }

    /**
     * Get associated user
     * @return collection
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
