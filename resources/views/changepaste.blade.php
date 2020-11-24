@extends('layouts.app')

@section('content')
<div class="container">
	@if (isset($success_message))		 
		<div class="alert alert-success">Successfully updated!</div>
	@endif
	<form action="{{ route('post.paste.change', ['code' => $paste->urlcode->code]) }}" method="post">
		@csrf
		<input type="hidden" name="code" value="{{ $paste->urlcode->code }}">
		<div class="form-group">
			<label for="change-title">Title</label>
			<input type="text" value="{{ $paste->title }}" class="form-control" id="change-title" name="title">
		</div>
		<div class="form-group">
			<label for="change-body">Body</label>
			<textarea name="body" class="form-control" id="change-body" cols="30" rows="10"
				name="body">{{ $paste->body }}</textarea>
		</div>
		<div class="form-group">
			<label for="change-exposure">Exposure</label>
			<select name="exposure" id="change-exposure" class="form-control" name="exposure">
				<option value="public" @if ($paste->exposure=='public')
					selected
					@endif >Public</option>
				<option value="unlisted" @if ($paste->exposure=='unlisted')
					selected
					@endif>Unlisted</option>
				<option value="private" @if ($paste->exposure=='private')
					selected
					@endif>Private</option>
			</select>
		</div>
		<div class="form-group">
			<label for="change-password">
				<span id="password-span" @if ($paste->exposure == 'private') class="d-none" @endif>Password</span>
				<span id="change-password-span" @if ($paste->exposure != 'private') class="d-none" @endif>Change password</span>
			</label>
			<div class="input-group mb-3" id="change-password">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<input type="checkbox" id="change-password-checkbox" name="changePassword">
					</div>
				</div>
				<input type="text" name="password" class="form-control" id="change-password-input"
					@if($paste->exposure=='private') value="******" @endif disabled>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-dark btn-lg">change</button>
		</div>
	</form>
</div>
@endsection