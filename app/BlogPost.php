<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id',
    ];

    /**
     * Get user that owns the blog post.
     * @return collection
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get associated comments.
     * @return collection
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

}
