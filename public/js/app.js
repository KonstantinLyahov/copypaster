$(document).ready(function() {
	$('#create-password-checkbox').on('change', function(){
		if(this.checked){
			$('#create-password-input').attr('disabled', false);
		} else {
			$('#create-password-input').attr('disabled', true);
		}
	});
});