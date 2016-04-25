$(function(){
	$('.dropdown').dropdown();

	$('.show-next').click(function(e) {
		e.preventDefault();
		$(this).next().children('.hidden').toggle();
	});
	$('.commentAction').click(function(e){
		e.preventDefault();
		var form = $(this).attr('act');
		$(this).parent().parent().children('.reply.form:not(' + form + ')').hide();
		$(this).parent().parent().children(form).toggle();
		$(this).parent().children('.commentAction').removeClass('active');
		$(this).addClass('active');
	});

	$('.ui.radio.checkbox').checkbox(); 
});