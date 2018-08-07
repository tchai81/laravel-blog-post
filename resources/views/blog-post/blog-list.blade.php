@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                    {{ __('blog_post.list_title') }}
                    </div>
                    <div class="float-right">
                        <a href="{{ route('blog-post.create') }}" class="btn btn-primary btn-sm">
                            {{ __('blog_post.list_create_post') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                @if (count($blogPosts) > 0)
                    <ul>
                        @foreach ($blogPosts as $blogPost)
                            <li>
                                <a href="{{ route('blog-post.edit', ['id' => $blogPost['id']]) }}">{{$blogPost['title']}}</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>{{ __('blog_post.list_empty') }}</p>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
