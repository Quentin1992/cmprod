let projectsHandler = new ProjectsHandler("frontend", null, "section");

$(document).ready(function(){
    $("nav button:nth-child(1)").css("backgroundColor", "#111111");
    projectsHandler.getProjects(1);
    $("nav button:nth-child(1)").on("click", function(){
        $("nav button").css("backgroundColor", "#4d4d4d");
        $("nav button:nth-child(1)").css("backgroundColor", "#111111");
        projectsHandler.category = "all";
        projectsHandler.currentPage = 1;
        projectsHandler.getProjects(projectsHandler.currentPage);
    });
    $("nav button:nth-child(2)").on("click", function(){
        $("nav button").css("backgroundColor", "#4d4d4d");
        $("nav button:nth-child(2)").css("backgroundColor", "#111111");
        projectsHandler.category = "video";
        projectsHandler.currentPage = 1;
        projectsHandler.getProjects(projectsHandler.currentPage);
    });
    $("nav button:nth-child(3)").on("click", function(){
        $("nav button").css("backgroundColor", "#4d4d4d");
        $("nav button:nth-child(3)").css("backgroundColor", "#111111");
        projectsHandler.category = "motionDesign";
        projectsHandler.currentPage = 1;
        projectsHandler.getProjects(projectsHandler.currentPage);
    });
});
