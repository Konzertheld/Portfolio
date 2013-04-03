$(document).ready(function() {
	var current = '';
	
	$(".photoset .setphoto").hide();
	$(".photoset").children().first().show();
	current = $(".photoset").children().first().attr("id");
	
	$("#photonavigator .setphoto").click(function() {
		var next = $(this).attr('id').replace("thumb", "");
		$("#" + current).fadeOut(400, function() {
			$("#" + next).fadeIn();
			current = next;
		});
	});
});

var hiddenPhotos = new Array();

function navigate_left()
{
	$("#photonavigator .setphoto").eq([hiddenPhotos.length]).hide();
	hiddenPhotos.push($("#photonavigator .setphoto").eq([hiddenPhotos.length]));
}

function navigate_right()
{
	var last = hiddenPhotos.pop();
	if(last != null) {
		last.show();
	}
}