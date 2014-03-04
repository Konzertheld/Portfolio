var highlightPhoto;
var highlightState = false;
$(".singlephoto_link").click(function(ev) {
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