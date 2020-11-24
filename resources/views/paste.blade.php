@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-body">
			<div class="card-title">{{ $paste->title }}</div>
			<div class="card-subtitle text-muted text-small">by {{ $paste->user? $paste->user->name: 'guest' }} on
				{{ date('d.m.Y', strtotime($paste->created_at)) }}</div>
			@if ($paste->created_at != $paste->updated_at)
			<div class="card-subtitle text-muted text-small">Last updated on
				{{ date('d.m.Y', strtotime($paste->updated_at)) }}</div>
			@endif
			<button class="btn btn-dark m-1 mt-2" id="copy-btn">Copy</button> <span class="d-none">Copied!</span>
			@if ($paste->user == Auth::user())
			<a href="{{ route('paste.change', ['code' => $paste->urlcode->code]) }}" class="btn btn-light">Change</a>
			@endif
			<div class="card-text border p-2 overflow-auto" style="max-height: 75vh">{{ $paste->body }}</div>
			<input type="text" class="d-none" id="copy-text" value="{{ $paste->body }}">
		</div>
	</div>
</div>
@endsection