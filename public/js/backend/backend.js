let reviewsHandler = new ReviewsHandler("backend", "#workOnPublication > div", "#reviewsDisplay > div > a");
let projectsHandler = new ProjectsHandler("backend", "#workOnPublication > div", "#projectsDisplay");
let articlesHandler = new ArticlesHandler("backend", "#workOnPublication > div", "#articlesDisplay");
let converter = new Converter();

$(document).ready(function(){
    if($("section").length > 0){
        $("#reviewsDisplay").hide();
        $("#projectsDisplay").hide();
        $("#articlesDisplay").hide();
        reviewsHandler.displayNewReviewButton();
        projectsHandler.displayNewProjectButton();
        articlesHandler.displayNewArticleButton();
        $("nav button:nth-child(1)").on("click", function(){
            $("nav button").css("backgroundColor", "#4d4d4d");
            $("nav button:nth-child(1)").css("backgroundColor", "#111111");
            reviewsHandler.getReviews();
            $("#reviewsDisplay").show();
            $("#projectsDisplay").hide();
            $("#articlesDisplay").hide();
        });
        $("nav button:nth-child(2)").on("click", function(){
            $("nav button").css("backgroundColor", "#4d4d4d");
            $("nav button:nth-child(2)").css("backgroundColor", "#111111");
            projectsHandler.getProjects();
            $("#reviewsDisplay").hide();
            $("#projectsDisplay").show();
            $("#articlesDisplay").hide();
        });
        $("nav button:nth-child(3)").on("click", function(){
            $("nav button").css("backgroundColor", "#4d4d4d");
            $("nav button:nth-child(3)").css("backgroundColor", "#111111");
            articlesHandler.getArticles();
            $("#reviewsDisplay").hide();
            $("#projectsDisplay").hide();
            $("#articlesDisplay").show();
        });
    }
});
