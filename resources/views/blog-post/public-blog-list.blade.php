@extends('layouts.app')

@section('content')
<div class="container">
    @if (count($blogPosts) > 0)
      @foreach ($blogPosts as $blogPost)
        <div class="row justify-content-center">
          <!-- Post Content Column -->
          <div class="col-lg-8">
            <!-- Title -->
            <h1 class="mt-4">{{ $blogPost['title'] }}</h1>
            <!-- Author -->
            <div class="float-left">
              {{ __('blog_post.public_list_by') }}
              <a href="mailto:{{ $blogPost['authorEmail'] }}">{{ $blogPost['authorName'] }}</a>
            </div>
             <!-- Date/Time -->
            <div class="float-right small">
              {{ $blogPost['dateDiff'] }} {{ __('blog_post.public_list_ago') }}
            </div>
            <div class="clearfix"></div>
            <hr>
            <!-- Post Content -->
            <div class="block-with-text">{!! $blogPost['contentTruncated'] !!}</div>
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="{{ route('blog-post.show', ['id' => $blogPost['id']]) }}">
                  <small class="text-muted">{{ __('blog_post.public_list_read_more') }}</small>
                </a>
              </li>
              @if ($blogPost['commentsCount'] > 0)
                <li class="list-inline-item">
                  <small class="text-muted">{{$blogPost['commentsCount']}} {{trans_choice('blog_post.comments', $blogPost['commentsCount'])}}</small>
                </li>
              @endIf
            </ul>
          </div>
        </div>
        @if(!$loop->last)
          <hr class="divider">
        @endif
      @endforeach
    @else
        <p>{{ __('blog_post.public_list_empty') }}</p>
    @endif
</div>
@endsection
