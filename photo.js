var highlightPhoto;
var highlightState = false;
$(".post img").click(function(ev) {
	if($(ev.target).is(highlightPhoto)) {
		highlightState = !highlightState;
		refreshHighlight();
		return;
	}
	else if(highlightPhoto != undefined) {
		highlightState = false;
		refreshHighlight();
	}
	
	highlightPhoto = $(ev.target);
	highlightState = true;
	refreshHighlight();
});

function refreshHighlight()
{
	if(highlightState) {
		highlightPhoto.attr("src", highlightPhoto.attr("src").replace("thumbs/", ""));
		highlightPhoto.attr("width", 800);
		highlightPhoto.css("max-width", "none");
		highlightPhoto.css("max-height", "none");
		highlightPhoto.parent().css("max-width", "820px");
		highlightPhoto.parent().css("max-height", "none");
		highlightPhoto.parent().parent().css("height","auto");
		highlightPhoto.parent().parent().css("width","auto");
		$(window).scrollTop(highlightPhoto.offset().top - 20);
	}
	else {
		highlightPhoto.removeAttr("width");
		highlightPhoto.css("max-width", "260px");
		highlightPhoto.css("max-height", "260px");
		highlightPhoto.parent().css("max-width", "280px");
		highlightPhoto.parent().css("max-height", "280px");
		highlightPhoto.parent().parent().css("height","280px");
		highlightPhoto.parent().parent().css("width","280px");
		$(window).scrollTop(0);
	}
}