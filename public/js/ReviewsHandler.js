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

    displayReviewForm(reviewData){
        let reviewForm = $("<form>", {action:"#"});
        let formTitle = $("<h3>");
        reviewForm.append(formTitle);
        reviewForm.append($("<label>", {for:"author", html:"Auteur de l'avis : "}));
        reviewForm.append($("<input>", {type:"text", name:"author", required:true}));
        reviewForm.append($("<label>", {for:"content", html:"Avis : "}));
        reviewForm.append($("<textarea>", {name:"content", required:true}));
        reviewForm.append($("<label>", {for:"image", html:"Image : "}));
        reviewForm.append($("<input>", {type:"file", name:"image", required:true}).on("change", function(e){
            $("#formImgDiv").remove();
            let image = $("<img>").attr("src", window.URL.createObjectURL(e.target.files[0]));
            $("<div>", {
                id:"formImgDiv"
            }).append(image).insertAfter($(this));
        }));
        reviewForm.append($("<input>", {type:"submit", name:"submitButton", value:"Ajouter cet avis"}));
        $(reviewsHandler.workLocation).html("");
        if(reviewData != undefined){
            reviewForm[0].author.value = reviewData.author;
            reviewForm[0].content.value = reviewData.content;
            reviewForm.children(":nth-child(5)").html("Modifier l'image actuelle : ");
            reviewForm.children(":nth-child(5)").removeAttr("required");
            reviewForm[0].submitButton.value = "Mettre à jour cet avis";
            formTitle.html("Modification de l'avis sélectionné");
        }
        else {
            formTitle.html("Création d'un avis");
        }
        reviewForm.on("submit", function(e){
            $("form input[type='file']").after($("<p>").html("Chargement..."));
            if(reviewData == undefined){
                reviewsHandler.addReview(e.target.author.value, e.target.content.value, e.target.image.files[0]);
            } else if(reviewData != undefined){
                reviewsHandler.updateReview(reviewData.id, e.target.author.value, e.target.content.value, e.target.image.files[0]);
            }
            e.preventDefault();
        });
        $(reviewsHandler.workLocation).append(reviewForm);
    }

    addReview(author, content, imageFile){
        var query = new FormData();
        query.append("action", "addReview");
        query.append("author", author);
        query.append("content", content);
        query.append("imageFile", imageFile);
        ajaxPost("index.php", query, function(response){
            $(reviewsHandler.workLocation).html("").append($("<div>").html("L'avis de " + author + " a été ajouté."));
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
            if(reviewsHandler.side == "backend")
                reviewsHandler.displayReviewsTable(reviews);
        });
    }

    displayReviewsTable(reviews){
        $("#reviewsTableLocation").html("");
        if(reviews[0] != undefined){
            let reviewsTable = $("<table>");
            let headersRow = $("<tr>");
            headersRow.append($("<th>").html("Image"));
            headersRow.append($("<th>").html("Commentaire"));
            headersRow.append($("<th>").html("Auteur"));
            headersRow.append($("<th>").html("Actions"));
            reviewsTable.append(headersRow);
            reviews.forEach(function(reviewData){
                let reviewRow = $("<tr>");
                reviewRow.append($("<td>").append($("<img>").attr({src:reviewData.imageFile, alt:"logo "+reviewData.author})));
                reviewRow.append($("<td>").append(reviewData.content));
                reviewRow.append($("<td>").append(reviewData.author));
                let updateButton = $("<button>").html("Modifier").on("click", function(){
                    $("#form-modal").show();
                    reviewsHandler.displayReviewForm(reviewData);
                });
                let deleteButton = $("<button>").html("Supprimer").on("click", function(){
                    reviewsHandler.deleteReview(reviewData.id);
                });
                reviewRow.append($("<td>").append(updateButton, deleteButton));
                reviewsTable.append(reviewRow);
            });
            $("#reviewsTableLocation").append(reviewsTable);
            $("html").animate({
                scrollTop: $("#reviewsButton").offset().top
            }, 1000);
        }
        else $("#reviewsTableLocation").append($("<p>").html("Pas d'avis à afficher"));
    }

    displayReview(reviewData){
        $(reviewsHandler.displayLocation).html("");
        let imgDiv = $("<div>").append($("<div>").append($("<img>").attr({src:reviewData.imageFile, alt:"logo "+reviewData.author})));
        $(reviewsHandler.displayLocation).append(imgDiv);
        let textDiv = $("<div>");
        textDiv.append($("<p>").html(reviewData.content));
        let authorDiv = $("<div>");
        authorDiv.append($("<i>").attr("class", "fas fa-circle"));
        authorDiv.append($("<span>").html(reviewData.author));
        textDiv.append(authorDiv);
        $(reviewsHandler.displayLocation).append(textDiv);
    }

    initSlider(reviews){
        reviewsHandler.currentReview = 0;
        reviewsHandler.displayReview(reviews[reviewsHandler.currentReview]);
        $("#previousSlideButton").first().off("click");
        $("#previousSlideButton").first().on("click", function(){
            reviewsHandler.previousSlide(reviews);
        });
        $("#nextSlideButton").last().off("click");
        $("#nextSlideButton").last().on("click", function(){
            reviewsHandler.nextSlide(reviews);
        });
    };

    nextSlide(reviews){
        reviewsHandler.currentReview++;
        if (reviewsHandler.currentReview === reviewsHandler.numberOfReviews)
            reviewsHandler.currentReview = 0;
        reviewsHandler.displayReview(reviews[reviewsHandler.currentReview]);
    };

    previousSlide(reviews){
        reviewsHandler.currentReview--;
        if (reviewsHandler.currentReview === -1)
            reviewsHandler.currentReview = reviewsHandler.numberOfReviews - 1;
        reviewsHandler.displayReview(reviews[reviewsHandler.currentReview]);
    }

    //UPDATE

    updateReview(id, author, content, imageFile){
        var query = new FormData();
        query.append("action", "updateReview");
        query.append("id", id);
        query.append("author", author);
        query.append("content", content);
        query.append("imageFile", imageFile);
        ajaxPost("index.php", query, function(response){
            $(reviewsHandler.workLocation).html("").append($("<div>").html("L'avis de " + author + " a été modifié."));
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
