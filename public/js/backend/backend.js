let reviewsHandler = new ReviewsHandler("backend", "#form-modal", "#reviewsDisplay > div > a");
let projectsHandler = new ProjectsHandler("backend", "#form-modal", "#projectsDisplay");
let articlesHandler = new ArticlesHandler("backend", "#form-modal", "#articlesDisplay");
let converter = new Converter();

$(document).ready(function(){
    let formModal = $("#form-modal");
    if($("section").length > 0){
        $("#reviewsDisplay").hide();
        $("#projectsDisplay").hide();
        $("#articlesDisplay").hide();
        //new publication buttons
        $("#newReviewButton").on("click", function(){
            reviewsHandler.displayReviewForm();
            formModal.show();
        });
        $("#newProjectButton").on("click", function(){
            projectsHandler.displayProjectForm();
            formModal.show();
        });
        $("#newArticleButton").on("click", function(){
            articlesHandler.displayArticleForm();
            formModal.show();
        });
        window.onclick = function(e) {
            if (e.target == document.getElementById("form-modal")) {
                formModal.hide();
            }
        }
        //display publications buttons
        $("#reviewsButton").on("click", function(){
            $("#projectsNav").remove();
            $("#publicationsSelector button").css("backgroundColor", "#4d4d4d");
            $("#reviewsButton").css("backgroundColor", "#111111");
            reviewsHandler.getReviews();
            $("#reviewsDisplay").show();
            $("#projectsDisplay").hide();
            $("#articlesDisplay").hide();
        });
        $("#projectsButton").on("click", function(){
            $("#publicationsSelector button").css("backgroundColor", "#4d4d4d");
            $("#projectsButton").css("backgroundColor", "#111111");
            projectsHandler.getProjects();
            $("#reviewsDisplay").hide();
            $("#projectsDisplay").show();
            $("#articlesDisplay").hide();
        });
        $("#articlesButton").on("click", function(){
            $("#projectsNav").remove();
            $("#publicationsSelector button").css("backgroundColor", "#4d4d4d");
            $("#articlesButton").css("backgroundColor", "#111111");
            articlesHandler.getArticles();
            $("#reviewsDisplay").hide();
            $("#projectsDisplay").hide();
            $("#articlesDisplay").show();
        });
    }
});
