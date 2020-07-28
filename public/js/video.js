const changeQuality = function(resolution){
    let curtime = video.currentTime;
    $('source','video').attr('src','public/videos/showreel_' + resolution + '.mp4');
    video.load();
    video.currentTime = curtime;
    video.play();
}

const videoControls = function(trigger, video, seekBar, container){
    $("#1080p").css("color", "rgba(77,77,77,0.9)");
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
    document.getElementById("720p").addEventListener("click", function(){
        changeQuality("720");
        trigger.style.display = "none";
        $(this).css("color", "#ffffff");
        $("#1080p").css("color", "rgba(77,77,77,0.9)");
    });
    document.getElementById("1080p").addEventListener("click", function(){
        changeQuality("1080");
        trigger.style.display = "none";
        $(this).css("color", "#ffffff");
        $("#720p").css("color", "rgba(77,77,77,0.9)");
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
