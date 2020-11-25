$(document).ready(function () {
	//create paste
	$('#create-password-checkbox').on('change', function () {
		if (this.checked) {
			$('#create-exposure').val('private');
			addPassword();
			$('#create-password-checkbox').attr('checked', true);
		} else {
			deletePassword();
			if ($('#create-exposure').val() == 'private') {
				$('#create-exposure').val('public');
			}
		}
	});
	$('#create-exposure').on('change', function () {
		if ($(this).val() == 'private') {
			if ($('#create-password-input').attr('disabled')) {
				addPassword();
			}
		} else {
			deletePassword();
		}
	});
	$('#copy-btn').on('click', function () {
		$('#copy-text').removeClass('d-none');
		var copyText = document.querySelector('#copy-text');
		copyText.select();
		document.execCommand('copy');
		$('#copy-text').addClass('d-none');
		$(this).next().removeClass('d-none')
	});

	//change paste
	$('#change-password-checkbox').on('change', function () {
		if (this.checked) {
			addPassword();
		} else {
			if ($('#change-exposure').val() == 'private') {
				deletePassword();
				$('#change-password-input').val('********');
			}
		}
	});
	$('#change-exposure').on('change', function () {
		if ($(this).val() != 'private') {
			$('#password-span').removeClass('d-none');
			$('#change-password-span').addClass('d-none');
			deletePassword();
		} else {
			$('#password-span').addClass('d-none');
			$('#change-password-span').removeClass('d-none');
			addPassword();
		}
	});
	$('#change-password-checkbox').on('change', function () {
		if (this.checked) {
			$('#change-exposure').val('private');
			$('#password-span').addClass('d-none');
			$('#change-password-span').removeClass('d-none');
		}
	});
});

function addPassword() {
	$('#create-password-input, #change-password-input').attr('disabled', false);
	$('#create-password-checkbox, #change-password-checkbox').attr('checked', true);
	$('#create-password-input, #change-password-input').val(Math.random().toString(36).substring(2));
}
function deletePassword() {
	$('#create-password-input, #change-password-input').attr('disabled', true);
	$('#create-password-checkbox, #change-password-checkbox').attr('checked', false);
	$('#create-password-checkbox, #change-password-checkbox').prop("checked", false);
	$('#create-password-input, #change-password-input').val('');
}

function confirmRedirect(url, msg) {
	if (confirm(msg)) {
		location.href = url;
	}
}