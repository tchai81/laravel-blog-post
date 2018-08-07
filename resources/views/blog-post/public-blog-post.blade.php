@extends('layouts.app')

@section('content')
<div class="container">
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
        {{ $blogPost['date'] }}
        @if ($blogPost['commentsCount'] > 0)
          ,{{$blogPost['commentsCount']}} {{trans_choice('blog_post.comments', $blogPost['commentsCount'])}}
        @endIf
      </div>
      <div class="clearfix"></div>
      <hr>
      <!-- Post Content -->
      <p>{!! $blogPost['content'] !!}</p>
        <!-- Comments Form -->
      <comment blog-post-id="{{ $blogPost['id'] }}"></comment>
    </div>
  </div>
</div>
@endsection
