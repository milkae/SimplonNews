$(function(){
	$('.dropdown').dropdown();

	$('.edit').click(function(e){
		e.preventDefault();
		$(this).next('.hidden').show();
	});

	$('.comment-res').click(function(e) {
		e.preventDefault();
		$(this).next('.hidden').show();
	});
});