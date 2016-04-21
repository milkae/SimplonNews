$(function(){
	$('.dropdown').dropdown();

	$('.show-next').click(function(e) {
		e.preventDefault();
		$(this).next('.hidden').show();
	});
	$('.commentAction').click(function(e){
		e.preventDefault();
		var form = $(this).attr('act');
		$(this).parent().parent().children('.reply.form:not(' + form + ')').hide();
		$(this).parent().parent().children(form).toggle();
	});
});