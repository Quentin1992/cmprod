$(document).ready(function(){
    $("#navbar > div:first-child > a > img").mouseenter(function(e){
        e.target.src = "public/images/logos/inlineLogoBlink-light.jpg";
        setTimeout(function(){
            e.target.src = "public/images/logos/inlineLogo.jpg";
        }, 250);
    });
});
