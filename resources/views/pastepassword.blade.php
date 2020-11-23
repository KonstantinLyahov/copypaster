@extends('layouts.app')

@section('content')
	<div class="container">
		@if (isset($incorrect_password_error))
			 <div class="alert alert-danger">
				Incorrect password
			 </div>
		@endif
		<h2>Enter password:</h2>
			<form action="{{ route('post.paste', ['code' => $code]) }}" method="POST">
				@csrf
				<div class="form-group">
					<input type="password" name="password" class="form-control">
				</div>
				<div class="form-group">
					<button class="btn btn-dark" type="submit">Submit</button>
				</div>
			</form>
	</div>
@endsection