<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Http\Requests\StoreBlogPost;
use App\Services\BlogPostService;
use Auth;
use Session;

class BlogPostController extends Controller
{

    public function __construct(BlogPostService $service)
    {
        $this->service = $service;
    }

    /**
     * Blog post Listing page
     * Accessible to public
     *
     * @return \Illuminate\Http\Response
     */

    public function publicIndex()
    {

        // get all blog posts
        $blogPosts = $this->service->getAll();
        return view('blog-post/public-blog-list')->with('blogPosts', $blogPosts);

    }

    /**
     * Dashboard page for both Owner and user
     * Accessible to login users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get current user
        $user = Auth::user();
        // check whether user has the role = "Owner"
        if ($user->isOwner()) {
            // retrieve blog posts for current user
            $blogPosts = $this->service->getByUserId($user);
            // show owner dashboard
            return view('blog-post/blog-list')->with('blogPosts', $blogPosts);
        } else {
            // show user dashboard
            return view('home');
        }

    }

    /**
     * Show Blog post creation page
     * Accessible only to login users
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('blog-post/blog-form');
    }

    /**
     * Handle saving of a blog post
     *
     * @param StoreBlogPost $request
     * @return Illuminate\Routing\Redirector
     */

    public function store(StoreBlogPost $request)
    {
        // attempt to save s blog post
        $blogPostFromRepo = $this->service->store(new BlogPost(), $request->all(), Auth::user());
        // succeeded?
        if (!is_null($blogPostFromRepo)) {
            // redirect user to edit form alongside with success message
            return redirect()
                ->route('blog-post.edit', ['id' => $blogPostFromRepo->id])
                ->with('success', __('blog_post.form_create_success', ['title' => $request->title]));

        }
        // if fail, redirect user back to creation page, showing error message
        return redirect()
            ->route('blog-post.create')
            ->with('error', __('blog_post.form_error_access_denied'));

    }

    /**
     * Showing a blog post.
     * Accessible to public
     *
     * @param Blogpost $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(Blogpost $blogPost)
    {
        $blogPostFromRepo = $this->service->getById($blogPost);
        return view('blog-post/public-blog-post', ['blogPost' => $blogPostFromRepo]);

    }

    /**
     * Showing blog post form for edit
     * Accessible to login user
     *
     * @param Blogpost $blogPost
     * @return \Illuminate\Http\Response
     */

    public function edit(Blogpost $blogPost)
    {
        // get the designated blog post
        $blogPostFromRepo = $this->service->getByIdForEdit($blogPost, Auth::user());
        // check whether user is authorized to edit
        if (!is_null($blogPostFromRepo)) {
            // showing edit form with details
            return view('blog-post/blog-form')->with('blogPost', $blogPostFromRepo);
        }
        // Showing edit form with error message
        Session::flash('error', __('blog_post.form_error_not_found'));
        return view('blog-post/blog-form');

    }

    /**
     * Handle operation of updating a blog post
     *
     * @param StoreBlogPost $request
     * @param BlogPost $blogPost
     * @return Illuminate\Routing\Redirector
     */

    public function update(StoreBlogPost $request, BlogPost $blogPost)
    {
        // Attempt to update a blogpost
        $blogPostFromRepo = $this->service->store($blogPost, $request->all(), Auth::user());
        // check whether operation is a success
        if (!is_null($blogPostFromRepo)) {
            // redirect user back to edit form with success message
            return redirect()
                ->route('blog-post.edit', ['id' => $blogPostFromRepo->id])
                ->with('success', __('blog_post.form_update_success', ['title' => $request->title]));
        }
        // if fails, redirect user back creation form with error message
        return redirect()
            ->route('blog-post.create')
            ->with('error', __('blog_post.form_error_access_denied'));

    }

    public function destroy($id)
    {
        //Not implemented
    }
}
