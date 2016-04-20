$(function(){
	$('.dropdown').dropdown();

	$('.show-next').click(function(e) {
		e.preventDefault();
		$(this).next('.hidden').show();
	});
	$('a.reply').click(function(e){
		e.preventDefault();
		$(this).parent().children('.reply.hidden').toggle();
	});
	$('a.edit').click(function(e){
		e.preventDefault();
		$(this).parent().children('.edit.hidden').toggle();
	});
});