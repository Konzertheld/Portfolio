var highlightPhoto;
var highlightState = false;

function hook_to_images() {
	$(".singlephoto_link").unbind('click').click(function(ev) {
		ev.preventDefault();
		image = $(ev.target);
		if(image.is(highlightPhoto)) {
			highlightState = !highlightState;
			refreshHighlight();
			return;
		}
		else if(highlightPhoto != undefined) {
			highlightState = false;
			refreshHighlight();
		}
		
		highlightPhoto = image;
		highlightState = true;
		refreshHighlight();
	});
}
hook_to_images();

$('#imagebox').bind("DOMSubtreeModified",function(){
	hook_to_images();
});

function refreshHighlight()
{
	if(highlightState) {
		highlightPhoto.attr("src", highlightPhoto.parent().attr("href"));
		if(window.innerWidth > 800) {
			highlightPhoto.attr("width", 800);
		}
		else {
			highlightPhoto.attr("width", 0.9 * window.innerWidth);
		}
		highlightPhoto.parent().parent().parent().addClass("highlighted");
		$(window).scrollTop(highlightPhoto.offset().top - 20);
	}
	else {
		highlightPhoto.removeAttr("width");
		highlightPhoto.parent().parent().parent().removeClass("highlighted");
		$(window).scrollTop(0);
	}
}