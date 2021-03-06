@extends('layouts.default')
@section('content')

<div class="col-8 offset-2 my-5">

	{{-- 投稿完了時にフラッシュメッセージを表示 --}}
	@if(Session::has('message'))
		<div class="alert alert-success">
			<p><i class="fas fa-info-circle"></i> {{ Session::get('message') }}</p>
		</div>
	@endif

	{{-- エラーメッセージの表示 --}}
	@foreach($errors->all() as $message)
		<p class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</p>
	@endforeach

	<div class="card">
		<h2 class="card-header">投稿ページ</h2>
			<div class="card-body">
				{{ Form::open(['route' => 'posts.store'], array('class' => 'form')) }}
				<div class="form-group">
					<label for="title" class="">タイトル</label>
					<div class="">
						{{ Form::text('title', null, array('class' => 'form-control')) }}
					</div>
				</div>

				@php
						$user_id = Auth::id();
				@endphp
				{{ Form::hidden("user_id", $user_id) }}
				<div class="form-group">
					<label for="cat_id" class="">カテゴリー</label>
					<div class="">
						<select class="form-control" name="cat_id" id="">
							<option></option>
							@foreach ($categories as $category)
							<option value="{{ $category->id }}" name="{{ $category->id }}" >{{ $category->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="content" class="">本文</label>
					<div class="">
						{{ Form::textarea('content', null, array('class' => 'form-control')) }}
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">投稿する</button>
				</div>

				{{ Form::hidden("comment_count", 0) }}

				{{ Form::close() }}
			</div>
		</div>
</div>

@stop