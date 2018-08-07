<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Controllers\ApiServiceController;
use App\Http\Requests\StoreComment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends ApiServiceController
{

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        // Not implemented
    }

    public function create()
    {
        // Not implemented
    }

    /**
     * Handle saving of a comment
     * Accessible to login user
     *
     * @param StoreComment $request
     * @return Illuminate\Support\Facades\Response
     */
    public function store(StoreComment $request)
    {
        // attempt to save the comment
        $comment = $this->service->store(new Comment(), $request->all(), auth('api')->user());
        // if succeeded?
        if (!is_null($comment)) {
            // return comment instance
            return $this->respondWithJson($comment);
        }
        // return error
        return $this->respondForbidden();
    }

    /**
     * Display comments based on blog post id
     * Accessible to public
     *
     * @param  int  $blogPostId
     * @return Illuminate\Support\Facades\Response
     */
    public function show($blogPostId)
    {
        return $this->respondWithJson($this->service->getByBlogPostId($blogPostId));
    }

    public function edit($id)
    {
        // Not implemented
    }

    public function update(Request $request, $id)
    {
        // Not implemented
    }

    public function destroy($id)
    {
        // Not implemented
    }
}
