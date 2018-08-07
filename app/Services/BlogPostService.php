<?php

namespace App\Services;

use App\BlogPost;
use App\Repositories\BlogPostRepository;
use App\Transformers\BlogPostTransformer;
use App\User;

class BlogPostService
{

    public function __construct(
        BlogPostRepository $repository,
        BlogPostTransformer $transformer
    ) {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    /**
     * Get all blog post
     *
     * @return array
     */

    public function getAll()
    {
        return $this->transformer->transformCollection($this->repository->getAll());
    }

    /**
     * Get a blog post by id
     *
     * @param Blogpost $blogPost
     * @return array
     */

    public function getById(Blogpost $blogPost)
    {
        return $this->transformer->transform($this->repository->getById($blogPost->id)->first()->toArray());
    }

    /**
     * Get a blog post by id
     * For Edit operation
     *
     * @param Blogpost $blogPost
     * @param User $user
     * @return array
     */

    public function getByIdForEdit(Blogpost $blogPost, User $user)
    {
        //get blog post
        $blogPostFromRepo = $this->repository->getById($blogPost->id)->first();
        //check whether user has permission to edit this blog post
        if ($this->checkHasPermission($blogPost, $user)) {
            //return blog post object if authorized
            return $this->transformer->transform($blogPost);
        }
        // return null if not authorized
        return null;

    }

    /**
     * Get all blog posts by user
     *
     * @param User $user
     * @return array
     */

    public function getByUserId(User $user)
    {
        return $this->transformer->transformCollection($this->repository->getByUserId($user->id));
    }

    /**
     * Handle saving operation
     *
     * @param BlogPost $blogpost
     * @param Array $data
     * @param User $user
     * @return mixed
     */

    public function store(BlogPost $blogPost, $data, User $user)
    {
        // check whether user has permission to save
        if ($this->checkHasPermission($blogPost, $user)) {
            //return $blogpost if yes
            $blogPost->fill($data);
            $blogPost->user_id = $user->id;
            $blogPost->save();
            return $blogPost;
        }
        // retun null if not authorized
        return null;
    }

    /**
     * Check whether user has permission to execute a given task
     *
     * @param BlogPost $blogPOst
     * @param User $user
     * @return Boolean
     */

    public function checkHasPermission(BlogPost $blogPost, User $user)
    {
        // check whether user has the user role = "owner"
        if ($user->isOwner()) {
            // if yes, we need to check whether user owns the post
            if ($blogPost->id) {
                return $blogPost->user_id === $user->id;
            }
            // if it's creation, omit the validation rule
            return true;
        }
        return false;
    }

}
