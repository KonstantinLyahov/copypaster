@extends('layouts.app')

@section('content')
<div class="container">
	<h3>Create paste</h3>
	<form action="{{ route('post.create') }}" method="post">
		@csrf
		<div class="form-group">
			<label for="create-title">Title</label>
			<input type="text" class="form-control" id="create-title" name="title">
		</div>
		<div class="form-group">
			<label for="create-body">Body</label>
			<textarea name="body" class="form-control" id="create-body" cols="30" rows="10" name="body"></textarea>
		</div>
		<div class="form-group">
			<label for="create-exposure">Exposure</label>
			<select name="exposure" id="create-exposure" class="form-control" name="exposure">
				<option value="public">Public</option>
				<option value="unlisted">Unlisted</option>
				<option value="private" @guest disabled @endguest>Private</option>
			</select>
		</div>
		<div class="form-group">
			<label for="create-password">Password</label>
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
			<button type="submit" class="btn btn-dark btn-lg">Create</button>
		</div>
	</form>
</div>
@endsection