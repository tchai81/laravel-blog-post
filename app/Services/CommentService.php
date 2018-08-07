<?php

namespace App\Services;

use App\Comment;
use App\Repositories\CommentRepository;
use App\Transformers\CommentTransformer;

class CommentService
{

    public function __construct(
        CommentRepository $repository,
        CommentTransformer $transformer
    ) {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    /**
     * Get comments based on blog post Id
     *
     * @param int $blogPostId
     * @return array
     */

    public function getByBlogPostId($blogPostId)
    {
        return $this->transformer->transformCollection($this->repository->getByBlogPostId($blogPostId));
    }

    /**
     * Save a comment
     *
     * @param Comment $comment
     * @param array $data
     * @param User $user
     * @return mixed
     */

    public function store(Comment $comment, $data, $user)
    {
        // only allow log in user to leave a comment
        if (!is_null($user)) {
            $comment->fill($data);
            $comment->user_id = $user->id;
            $comment->save();
            return $comment;
        }
        return null;
    }

}
