<form id="paste-{{ $paste->urlcode->code }}" action="{{ route('post.paste', ['code' => $paste->urlcode->code]) }}" method="post" class="d-none">
	@csrf
</form>

<script>
	document.getElementById('paste-{{ $paste->urlcode->code }}').submit();
</script>