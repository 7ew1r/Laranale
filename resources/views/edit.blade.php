@extends('layouts.default')
@section('content')

<div class="col-8 offset-2">

<h1>記事編集ページ</h1>

{{-- 投稿完了時にフラッシュメッセージを表示 --}}
@if(Session::has('message'))
	<div class="bg-info">
		<p>{{ Session::get('message') }}</p>
	</div>
@endif

{{-- エラーメッセージの表示 --}}
@foreach($errors->all() as $message)
	<p class="bg-danger">{{ $message }}</p>
@endforeach

<form action="{{ route('posts.update',['id' => $post->id]) }}" method="POST">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
	<div class="form-group">
		<label for="title" class="">タイトル</label>
		<div class="">
			{{ Form::text('title', $post->title, array('class' => '')) }}
		</div>
	</div>

	@php
			$user_id = Auth::id();
	@endphp
	{{ Form::hidden("user_id", $user_id) }}
	<div class="form-group">
		<label for="cat_id" class="">カテゴリー</label>
		<div class="">
			<select name="cat_id" id="">
				<option></option>
				@foreach ($categories as $category)
          <option value="{{ $category->id }}" name="{{ $category->id }}"
            @if ( $category->id == $post->cat_id )
                selected
            @endif
          >
          {{ $category->name }}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="content" class="">本文</label>
		<div class="">
			{{ Form::textarea('content', $post->content, array('class' => '')) }}
		</div>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">投稿する</button>
	</div>

{{ Form::close() }}

</div>

@stop