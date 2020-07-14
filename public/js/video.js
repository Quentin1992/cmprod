const videoControls = function(trigger, video, seekBar, container){
    trigger.addEventListener("click", function(e){
        if(video.paused){
            video.play();
            trigger.style.display = "none";
        } else {
            video.pause();
            trigger.style.display = "inline";
        }
    });
    video.addEventListener("click", function(e){
        if(video.paused){
            video.play();
            trigger.style.display = "none";
        } else {
            video.pause();
            trigger.style.display = "inline";
        }
    });
    // updates the seek bar as the video plays
    video.addEventListener("timeupdate", function() {
        let value = (100 / video.duration) * video.currentTime;
        document.getElementsByTagName("line")[0].setAttribute("x2", value + "%");
    });
    document.getElementById("full-screen").addEventListener("click", function() {
        if (document.fullscreenElement) {
            document.exitFullscreen();
        } else {
            container.requestFullscreen()
        }
    });
    video.addEventListener("ended", function () {
        if(document.fullscreenElement){
            $.when(document.exitFullscreen() ).then(function() {
                $("header > div").hide();
                $("html").animate({
                    scrollTop: $("#navbar").offset().top
                }, 1000);
            });
        }
        else {
            $("header > div").hide();
            $("html").animate({
                scrollTop: $("#navbar").offset().top
            }, 1000);
        }
    });
}
