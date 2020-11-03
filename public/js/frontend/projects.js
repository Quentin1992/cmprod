let projectsHandler = new ProjectsHandler("frontend", null, "section");

$(document).ready(function(){
    $("#categorySelector button:nth-child(1)").css("backgroundColor", "#111111");
    projectsHandler.getProjects(1);
    $("#categorySelector button:nth-child(1)").on("click", function(){
        $("#categorySelector button").css("backgroundColor", "#4d4d4d");
        $("#categorySelector button:nth-child(1)").css("backgroundColor", "#111111");
        projectsHandler.category = "all";
        projectsHandler.currentPage = 1;
        projectsHandler.getProjects(projectsHandler.currentPage);
    });
    $("#categorySelector button:nth-child(2)").on("click", function(){
        $("#categorySelector button").css("backgroundColor", "#4d4d4d");
        $("#categorySelector button:nth-child(2)").css("backgroundColor", "#111111");
        projectsHandler.category = "video";
        projectsHandler.currentPage = 1;
        projectsHandler.getProjects(projectsHandler.currentPage);
    });
    $("#categorySelector button:nth-child(3)").on("click", function(){
        $("#categorySelector button").css("backgroundColor", "#4d4d4d");
        $("#categorySelector button:nth-child(3)").css("backgroundColor", "#111111");
        projectsHandler.category = "motionDesign";
        projectsHandler.currentPage = 1;
        projectsHandler.getProjects(projectsHandler.currentPage);
    });
});
