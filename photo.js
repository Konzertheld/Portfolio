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
		// highlightPhoto.attr("src", highlightPhoto.attr("src").replace(".deriv/", ""));
		// highlightPhoto.attr("src", highlightPhoto.attr("src").replace(".thumbnail/", ""));
		highlightPhoto.attr("width", 800);
		highlightPhoto.css("max-width", "none");
		highlightPhoto.css("max-height", "none");
		highlightPhoto.parent().parent().css("max-width", "820px");
		highlightPhoto.parent().parent().css("max-height", "none");
		highlightPhoto.parent().parent().parent().css("height","auto");
		highlightPhoto.parent().parent().parent().css("width","auto");
		$(window).scrollTop(highlightPhoto.offset().top - 20);
	}
	else {
		highlightPhoto.removeAttr("width");
		highlightPhoto.css("max-width", "");
		highlightPhoto.css("max-height", "");
		highlightPhoto.parent().parent().css("max-width", "");
		highlightPhoto.parent().parent().css("max-height", "");
		highlightPhoto.parent().parent().parent().css("height", "");
		highlightPhoto.parent().parent().parent().css("width", "");
		$(window).scrollTop(0);
	}
}