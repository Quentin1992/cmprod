let reviewsHandler = new ReviewsHandler("frontend", null, "#reviewsDisplay a");
reviewsHandler.getReviews();

$(document).ready(function(){
    videoControls(document.getElementById("video-button"), document.getElementById("video"), document.getElementById("seek-bar"), document.getElementById("container"));
});
