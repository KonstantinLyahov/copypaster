@extends('layouts.app')

@section('content')
<div class="container">
	@if ($paste->deleted_at && $paste->user != Auth::user())
	{{ __('paste.content_not_available') }}
	@else
	<div class="card">
		<div class="card-body">
			<div class="card-title">{{ $paste->title }}</div>
			<div class="card-subtitle text-muted text-small">{{ __('paste.by') }} {{ $paste->user? $paste->user->name: __('paste.guest') }} {{ __('paste.on') }}
				{{ date('d.m.Y', strtotime($paste->created_at)) }}</div>
			@if ($paste->created_at != $paste->updated_at)
			<div class="card-subtitle text-muted text-small">{{ __('paste.last_updated') }} {{ __('paste.on') }}
				{{ date('d.m.Y', strtotime($paste->updated_at)) }}</div>
			@endif
			<button class="btn btn-dark m-1 mt-2" id="copy-btn">{{ __('paste.copy') }}</button> <span
				class="d-none">{{ __('paste.copied') }}</span>
			@if($paste->deleted_at)
			<button onclick="confirmRedirect(`{{ route('restore', ['code' => $paste->urlcode->code]) }}`, '{{ __('paste.sure') }}')"
				class="btn btn-light">{{ __('paste.restore') }}</button>
			<button
				onclick="confirmRedirect(`{{ route('force-delete', ['code' => $paste->urlcode->code]) }}`, '{{ __('paste.sure') }}')"
				class="btn btn-danger">{{ __('paste.delete_fully') }}</button>
			@elseif ($paste->user == Auth::user())
			<a href="{{ route('paste.change', ['code' => $paste->urlcode->code]) }}" class="btn btn-light">{{ __('paste.change') }}</a>
			<button
				onclick="confirmRedirect(`{{ route('paste.delete', ['code' => $paste->urlcode->code]) }}`, '{{ __('paste.sure') }}')"
				class="btn btn-danger">{{ __('paste.delete') }}</button>
			@endif
			<div class="card-text border p-2 overflow-auto" style="max-height: 75vh">{{ $paste->body }}</div>
			<input type="text" class="d-none" id="copy-text" value="{{ $paste->body }}">
		</div>
	</div>
	@endif
</div>
@endsection