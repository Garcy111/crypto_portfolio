$(function(){
	$('.btn-settings').mytoggle(function(e) {
		e.preventDefault();
		$('.additional-settings').show();
	}, function(e) {
		e.preventDefault();
		$('.additional-settings').hide();
	});
});