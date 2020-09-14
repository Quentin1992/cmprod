class ReviewsHandler {

    constructor(side, workLocation, displayLocation){
        this.workLocation = workLocation;
        this.displayLocation = displayLocation;
        //frontend or backend ?
        this.side=side;
        this.currentReview=0;
        this.numberOfReviews;
    }

    //CREATE

    displayNewReviewButton(){
        $(reviewsHandler.workLocation).append($("<button>").html("Ajouter un nouvel avis").on("click", function(e){
            $(reviewsHandler.workLocation).html("");
            reviewsHandler.displayReviewForm();
        }));
    }

    displayReviewForm(reviewData){
        let reviewForm = $("<form>", {action:"#"});
        reviewForm.append($("<label>", {for:"author", html:"Auteur de l'avis : "}));
        reviewForm.append($("<input>", {type:"text", name:"author", required:true}));
        reviewForm.append($("<label>", {for:"content", html:"Avis : "}));
        reviewForm.append($("<textarea>", {name:"content", required:true}));
        reviewForm.append($("<label>", {for:"imgLocation", html:"Image : "}));
        reviewForm.append($("<input>", {type:"file", name:"imgLocation", required:true}).on("change", function(e){
            $("#formImgDiv").remove();
            let image = $("<img>").attr("src", window.URL.createObjectURL(e.target.files[0]));
            $("<div>", {
                id:"formImgDiv"
            }).append(image).insertAfter($(this));
        }));
        reviewForm.append($("<input>", {type:"submit", name:"submitButton", value:"Ajouter cet avis"}));
        reviewForm.append($("<button>").html("Annuler").on("click", function(){
            $(reviewsHandler.workLocation).html("");
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
        }));
        $(reviewsHandler.workLocation).html("");
        if(reviewData != undefined){
            reviewForm[0].author.value = reviewData.author;
            reviewForm[0].content.value = reviewData.content;
            reviewForm.children(":nth-child(5)").html("Modifier l'image actuelle : ");
            reviewForm.children(":nth-child(5)").removeAttr("required");
            reviewForm[0].submitButton.value = "Mettre à jour cet avis";
            $(reviewsHandler.workLocation).append($("<h3>").html("Modification de l'avis sélectionné"));
        }
        else {
            $(reviewsHandler.workLocation).append($("<h3>").html("Création d'un avis"));
        }
        reviewForm.on("submit", function(e){
            if(reviewData == undefined){
                reviewsHandler.addReview(e.target.author.value, e.target.content.value, e.target.imgLocation.files[0]);
            } else if(reviewData != undefined){
                reviewsHandler.updateReview(reviewData.id, e.target.author.value, e.target.content.value, e.target.imgLocation.files[0]);
            }
            e.preventDefault();
        });
        $(reviewsHandler.workLocation).append(reviewForm);
    }

    addReview(author, content, imgLocation){
        var query = new FormData();
        query.append("action", "addReview");
        query.append("author", author);
        query.append("content", content);
        query.append("imgLocation", imgLocation);
        ajaxPost("index.php", query, function(response){
            $(reviewsHandler.workLocation).html("").append($("<div>").html("L'avis de " + author + " a été ajouté."));
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
            reviewsHandler.getReviews();
        });
    }

    //READ

    getReviews(){
        let query = new FormData();
        query.append("action", "getReviews");
        ajaxPost("index.php", query, function(response){
            let reviews = JSON.parse(response);
            reviewsHandler.numberOfReviews = reviews.length;
            reviewsHandler.initSlider(reviews);
        });
    }

    displayReview(reviewData){
        $(reviewsHandler.displayLocation).html("");
        let imgDiv = $("<div>").append($("<div>").append($("<img>").attr("src", reviewData.imgLocation)));
        $(reviewsHandler.displayLocation).append(imgDiv);
        let textDiv = $("<div>");
        textDiv.append($("<p>").html(reviewData.content));
        let authorDiv = $("<div>");
        authorDiv.append($("<i>").attr("class", "fas fa-circle"));
        authorDiv.append($("<span>").html(reviewData.author));
        textDiv.append(authorDiv);
        $(reviewsHandler.displayLocation).append(textDiv);
        if(reviewsHandler.side == "backend"){
            let buttonsLocation = $(reviewsHandler.displayLocation).parent().parent().children().eq(1);
            buttonsLocation.html("");
            buttonsLocation.append($("<button>").html("Modifier").on("click", function(){
                reviewsHandler.displayReviewForm(reviewData);
            }));
            buttonsLocation.append($("<button>").html("Supprimer").on("click", function(){
                reviewsHandler.deleteReview(reviewData.id);
            }));
        }
    }

    initSlider(reviews){
        reviewsHandler.currentReview = 0;
        reviewsHandler.displayReview(reviews[reviewsHandler.currentReview]);
        $("#reviewsDisplay > div:first-child button").first().off("click");
        $("#reviewsDisplay > div:first-child button").first().on("click", function(){
            reviewsHandler.previousSlide(reviews);
        });
        $("#reviewsDisplay > div:first-child button").last().off("click");
        $("#reviewsDisplay > div:first-child button").last().on("click", function(){
            reviewsHandler.nextSlide(reviews);
        });
    };

    nextSlide(reviews){
        console.log("next");
        reviewsHandler.currentReview++;
        if (reviewsHandler.currentReview === reviewsHandler.numberOfReviews)
            reviewsHandler.currentReview = 0;
        reviewsHandler.displayReview(reviews[reviewsHandler.currentReview]);
    };

    previousSlide(reviews){
        console.log("prev");
        reviewsHandler.currentReview--;
        if (reviewsHandler.currentReview === -1)
            reviewsHandler.currentReview = reviewsHandler.numberOfReviews - 1;
        reviewsHandler.displayReview(reviews[reviewsHandler.currentReview]);
    }

    //UPDATE

    updateReview(id, author, content, imgLocation){
        var query = new FormData();
        query.append("action", "updateReview");
        query.append("id", id);
        query.append("author", author);
        query.append("content", content);
        query.append("imgLocation", imgLocation);
        ajaxPost("index.php", query, function(response){
            $(reviewsHandler.workLocation).html("").append($("<div>").html("L'avis de " + author + " a été modifié."));
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
            reviewsHandler.getReviews();
        });
    }

    //DELETE

    deleteReview(reviewId){
        if(confirm("Supprimer cet avis ?")){
            let query = new FormData();
            query.append("action", "deleteReview");
            query.append("id", reviewId);
            ajaxPost("index.php", query, function(response){
                reviewsHandler.getReviews();
            });
        }
    }

}
