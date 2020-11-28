@if (count($pastes)==0)
	 <h2>Nothing here</h2>
	@else
	<table class="table">
		<thead>
			<tr>
				<th scope="col">{{ __('paste.title') }}</th>
				<th scope="col">{{ __('paste.create_date') }}</th>
				<th scope="col">{{ __('paste.user') }}</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($pastes as $paste)
			<tr class="pastelist-tr" onclick="location.href=`{{ route('get.paste', ['code' => $paste->urlcode->code]) }}`">
				<td>{{ $paste->title }}</td>
				<td>{{ date('d.m.Y', strtotime($paste->created_at)) }}</td>
				<td>{{ $paste->user?$paste->user->name:__('paste.guest') }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
@endif