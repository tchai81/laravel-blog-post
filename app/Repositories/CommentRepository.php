<?php

namespace App\Repositories;

use App\Comment;

class CommentRepository
{
    /**
     * Get comments by blog post Id
     * @param int $id
     * @return collection
     */

    public function getByBlogPostId($id)
    {
        return Comment::with('user')
            ->where('blog_post_id', $id)
            ->orderBy('updated_at', 'DESC')
            ->get();
    }
}
