$(document).ready(function(){
    $("#navbar > div:first-child > a > img").mouseenter(function(e){
        e.target.src = "public/images/logos/inlineLogoBlink-light.jpg";
        setTimeout(function(){
            e.target.src = "public/images/logos/inlineLogo.jpg";
        }, 250);
    });

    $("#navbar > div:last-child > nav > a:last-child").on("touchstart", function(e){
        $("#navbar > div:last-child").css("box-shadow", "-3px 3px 10px");
        $("#navbar > div:last-child > nav").css("flex-direction", "column-reverse");
        $("#navbar > div:last-child > nav > a").css("display", "block");
        $("#navbar > div:last-child > nav > a:last-child").css("display", "none");
        e.preventDefault();
    });
    $("header").on("touchstart", function(e){
        $("#navbar > div:last-child").css("box-shadow", "none");
        $("#navbar > div:last-child > nav > a").css("display", "none");
        $("#navbar > div:last-child > nav > a:last-child").css("display", "flex");
    });
    $("section").on("touchstart", function(e){
        $("#navbar > div:last-child").css("box-shadow", "none");
        $("#navbar > div:last-child > nav > a").css("display", "none");
        $("#navbar > div:last-child > nav > a:last-child").css("display", "flex");
    });
});
