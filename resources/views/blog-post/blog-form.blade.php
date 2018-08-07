@extends('layouts.app')

@section('content')
<div class="container">
    @if(\Session::has('success'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-success">
                    <strong>{{\Session::get('success')}}</strong>
                </div>
            </div>
        </div>
    @elseif(\Session::has('error'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-danger">
                    <strong>{{\Session::get('error')}}</strong>
                </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if (!empty($blogPost))
                        {{ __('blog_post.form_update_post', ['title' => $blogPost['title']]) }}
                    @else
                        {{ __('blog_post.form_create_post') }}
                    @endif
                </div>

                <div class="card-body">
                    @if (!empty($blogPost))
                        {{ Form::open(['action' => array('BlogPostController@update', $blogPost['id']), 'method' => 'PATCH']) }}
                    @else
                        {{ Form::open(['action' => 'BlogPostController@store', 'method' => 'POST']) }}
                    @endif
                        @csrf
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('blog_post.form_title') }}*</label>

                            <div class="col-md-10">
                                <input
                                    id="title"
                                    type="text"
                                    class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                                    name="title"
                                    value="{{ old('title', !empty($blogPost) ? $blogPost['title'] : '') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('blog_post.form_content') }}*</label>

                            <div class="col-md-10">
                                <textarea
                                    id="content"
                                    type="text"
                                    class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                    rows="10"
                                    name="content" autofocus>{{ old('content', !empty($blogPost) ? $blogPost['content'] : '') }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                @if (!empty($blogPost))
                                    {{ __('blog_post.form_update') }}
                                @else
                                    {{ __('blog_post.form_create') }}
                                @endif
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-primary">{{ __('blog_post.form_back') }}</a>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({selector:'#content'});
</script>



<!-- Start of productizehqhelp Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=cd75287d-042c-490d-bb84-69aecad0ef9b"> </script>
<!-- End of productizehqhelp Zendesk Widget script -->


<script type="text/javascript">
window.zESettings = {
  webWidget: {
    contactOptions: {
      enabled: true,
    contactButton: { '*': 'Contact Button' },
    chatLabelOnline: { '*': 'Live Chat' },
    chatLabelOffline: { '*': 'Chat is unavailable' },
    contactFormLabel: { '*': 'Leave us a message' }
    }
  }
};
</script>

@endsection
