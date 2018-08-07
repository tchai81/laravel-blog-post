<?php

namespace App\Repositories;

use App\BlogPost;

class BlogPostRepository
{

    /**
     * Get all blog posts
     * @return collection
     */

    public function getAll()
    {
        return BlogPost::with('user')
            ->withCount('comments')
            ->orderBy('updated_at', 'DESC')
            ->get();
    }

    /**
     * Get singular blog post by id
     * @param int $id
     * @return collection
     */

    public function getById($id)
    {
        return BlogPost::with(['user'])
            ->withCount('comments')
            ->where('id', $id)
            ->get();

    }

    /**
     * Get all blog post by user id
     * @param int $userId
     * @return collection
     */

    public function getByUserId($userId)
    {
        return BlogPost::with('user')
            ->withCount('comments')
            ->where('user_id', $userId)
            ->get();
    }

}
