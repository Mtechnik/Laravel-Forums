$(document).ready(function ()
{
	$("#form_submit").click(function()
	{
		$("#target_form").submit();
	});

	$(".delete_group").click(function(event)
	{
		$("#btn_delete_group").prop('href', '/forum/group/' + event.target.id + '/delete');
	});

	$(".delete_category").click(function(event)
	{
		$("#btn_delete_category").prop('href', '/forum/category/' + event.target.id + '/delete');
	});
});