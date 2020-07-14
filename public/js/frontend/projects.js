let projectsHandler = new ProjectsHandler("frontend", null, "section");

$(document).ready(function(){
    $("nav button:nth-child(1)").css("backgroundColor", "#111111");
    projectsHandler.getProjects();
    $("nav button:nth-child(1)").on("click", function(){
        $("nav button").css("backgroundColor", "#4d4d4d");
        $("nav button:nth-child(1)").css("backgroundColor", "#111111");
        projectsHandler.getProjects("all");
    });
    $("nav button:nth-child(2)").on("click", function(){
        $("nav button").css("backgroundColor", "#4d4d4d");
        $("nav button:nth-child(2)").css("backgroundColor", "#111111");
        projectsHandler.getProjects("video");
    });
    $("nav button:nth-child(3)").on("click", function(){
        $("nav button").css("backgroundColor", "#4d4d4d");
        $("nav button:nth-child(3)").css("backgroundColor", "#111111");
        projectsHandler.getProjects("motionDesign");
    });
});
