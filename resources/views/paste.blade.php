@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-body">
			<div class="card-title">{{ $paste->title }}</div>
			<div class="card-subtitle text-muted mb-2 text-small">by {{ $paste->user? $paste->user->name: 'guest' }}</div>
			<button class="btn btn-dark m-1" id="copy-btn">Copy</button> <span class="d-none">Copied!</span>
			<div class="card-text border p-2 overflow-auto" style="height: 75vh">{{ $paste->body }}</div>
			<input type="text" class="d-none" id="copy-text" value="{{ $paste->body }}">
		</div>
	</div>
</div>
@endsection