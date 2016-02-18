$(function(){
	$('.dropdown').dropdown();

	$('.show-next').click(function(e) {
		e.preventDefault();
		$(this).next('.hidden').show();
	});
});