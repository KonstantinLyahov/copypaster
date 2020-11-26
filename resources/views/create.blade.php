@extends('layouts.app')

@section('content')
<div class="container">
	<h3>{{ __('paste.create') }}</h3>
	<form action="{{ route('post.create') }}" method="post">
		@csrf
		<div class="form-group">
			<label for="create-title">{{ __('paste.title') }}</label>
			<input type="text" class="form-control" id="create-title" name="title">
		</div>
		<div class="form-group">
			<label for="create-body">{{ __('paste.body') }}</label>
			<textarea name="body" class="form-control" id="create-body" cols="30" rows="10" name="body"></textarea>
		</div>
		<div class="form-group">
			<label for="create-exposure">{{ __('paste.exposure') }}</label>
			<select name="exposure" id="create-exposure" class="form-control" name="exposure">
				<option value="public">{{ __('paste.public') }}</option>
				<option value="unlisted">{{ __('paste.unlisted') }}</option>
				<option value="private" @guest disabled @endguest>{{ __('paste.private') }}</option>
			</select>
		</div>
		<div class="form-group">
			<label for="create-password">{{ __('paste.password') }}</label>
			<div class="input-group mb-3" id="create-password">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<input type="checkbox" id="create-password-checkbox" @guest disabled @endguest>
					</div>
				</div>
				<input type="text" name="password" class="form-control" id="create-password-input" disabled>
			</div>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-dark btn-lg">{{ __('paste.create') }}</button>
		</div>
	</form>
</div>
@endsection