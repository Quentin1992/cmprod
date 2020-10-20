class ArticlesHandler {

    constructor(side, workLocation, displayLocation){
        this.workLocation = workLocation;
        this.displayLocation = displayLocation;
        //frontend or backend ?
        this.side=side;
    }

    //CREATE

    displayNewArticleButton(){
        $(articlesHandler.workLocation).append($("<button>").html("Ajouter un nouvel article").on("click", function(e){
            $(articlesHandler.workLocation).html("");
            articlesHandler.displayArticleForm();
        }));
    }

    displayArticleForm(articleData){
        let articleForm = $("<form>", {action:"#"});
        articleForm.append($("<label>", {for:"author", html:"Auteur de l'article : "}));
        articleForm.append($("<input>", {type:"text", name:"author", required:true}));
        articleForm.append($("<label>", {for:"title", html:"Titre de l'article : "}));
        articleForm.append($("<input>", {type:"text", name:"title", required:true}));
        articleForm.append($("<label>", {for:"date", html:"Date de parution : "}));
        let selectDiv = $("<div>", {id:"date"});
        let selectDay = $("<select>", {id:"day"});
        for(let i=1; i <= 31; i++){selectDay.append($("<option>", {value:i, html:i}));}
        selectDiv.append(selectDay);
        selectDiv.append($("<span>").html(" / "));
        let selectMonth = $("<select>", {id:"month"});
        for(let i=1; i <= 12; i++){selectMonth.append($("<option>", {value:i, html:i}));}
        selectDiv.append(selectMonth);
        selectDiv.append($("<span>").html(" / "));
        let selectYear = $("<select>", {id:"year"});
        for(let i=2015; i <= 2050; i++){selectYear.append($("<option>", {value:i, html:i}));}
        selectDiv.append(selectYear);
        articleForm.append(selectDiv);
        articleForm.append($("<label>", {for:"imageFile", html:"Logo de l'auteur : "}));
        articleForm.append($("<input>", {type:"file", name:"imageFile", required:true}).on("change", function(e){
            $("#formImgDiv").remove();
            let image = $("<img>").attr("src", window.URL.createObjectURL(e.target.files[0]));
            $("<div>", {
                id:"formImgDiv"
            }).append(image).insertAfter($(this));
        }));
        articleForm.append($("<label>", {for:"url", html:"Lien vers l'article : "}));
        articleForm.append($("<input>", {type: "text", name:"url"}));
        articleForm.append($("<input>", {type:"submit", name:"submitButton", value:"Ajouter cet article"}));
        articleForm.append($("<button>").html("Annuler").on("click", function(){
            $(articlesHandler.workLocation).html("");
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
        }));
        $(projectsHandler.workLocation).html("");
        if(articleData != undefined){
            console.log(articleData.date);
            let dateNumbers = converter.dateToInt(articleData.date);
            articleForm[0].author.value = articleData.author;
            articleForm[0].title.value = articleData.title;
            console.log(dateNumbers);
            articleForm[0].day.value = dateNumbers.day;
            articleForm[0].month.value = dateNumbers.month;
            articleForm[0].year.value = dateNumbers.year;
            articleForm.children(":nth-child(11)").html("Modifier le logo actuel : ");
            articleForm.children(":nth-child(12)").removeAttr("required");
            //$("<img>").attr("src", articleData.imageFile).insertAfter(articleForm[0].imageFile);
            articleForm[0].url.value = articleData.url;
            articleForm[0].submitButton.value = "Mettre à jour cet article";
            $(articlesHandler.workLocation).append($("<h3>").html("Modification de l'article sélectionné"));
        } else{
            $(articlesHandler.workLocation).append($("<h3>").html("Création d'un article"));
        }
        articleForm.on("submit", function(e){
            let date = converter.intToDate(e.target.day.value, e.target.month.value, e.target.year.value);
            if(articleData == undefined)
                articlesHandler.addArticle(e.target.author.value, e.target.title.value, date, e.target.imageFile.files[0], e.target.url.value);
            else if(articleData != undefined)
                articlesHandler.updateArticle(articleData.id, e.target.author.value, e.target.title.value, date, e.target.imageFile.files[0], e.target.url.value);
            e.preventDefault();
        });
        $(articlesHandler.workLocation).append(articleForm);
    }

    addArticle(author, title, date, imageFile, url){
        var query = new FormData();
        query.append("action", "addArticle");
        query.append("author", author);
        query.append("title", title);
        query.append("date", date);
        query.append("imageFile", imageFile);
        query.append("url", url);
        ajaxPost("index.php", query, function(response){
            $(articlesHandler.workLocation).html("").append($("<div>").html("L'article " + title + " a été ajouté."));
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
            articlesHandler.getArticles();
        });
    }

    //READ

    getArticles(){
        let query = new FormData();
        query.append("action", "getArticles");
        ajaxPost("index.php", query, function(response){
            let articles = JSON.parse(response);
            $(articlesHandler.displayLocation).html("");
            articlesHandler.displayArticles(articles);
        });
    }

    displayArticles(articles){
        if(articles[0] != undefined){
            articles.forEach(function(articleData){
                let visibleDiv = $("<div>");
                let articleLink = $("<a>");
                articleLink.append($("<div>").append($("<img>").attr("src", articleData.imageFile)));
                let textDiv = $("<div>");
                textDiv.append($("<h3>").html(articleData.author));
                textDiv.append($("<h4>").html(articleData.title));
                textDiv.append($("<p>").html(articleData.date));
                articleLink.append(textDiv);
                visibleDiv.append(articleLink);
                if(articlesHandler.side == "frontend"){
                    $(articlesHandler.displayLocation).append($("<div>").append(visibleDiv));
                }
                else {
                    let adminDiv = $("<div>");
                    adminDiv.append(visibleDiv);
                    let buttonsDiv = $("<div>");
                    buttonsDiv.append($("<button>").html("Modifier").on("click", function(){
                        articlesHandler.displayArticleForm(articleData);
                    }));
                    buttonsDiv.append($("<button>").html("Supprimer").on("click", function(){
                        articlesHandler.delete(articleData.id);
                    }));
                    adminDiv.append(buttonsDiv);
                    $(articlesHandler.displayLocation).append(adminDiv);
                }
            });
        }
        else $(articlesHandler.displayLocation).append($("<p>").html("Aucun article pour le moment."));
    }

    //UPDATE

    updateArticle(id, author, title, date, imageFile, url){
        var query = new FormData();
        query.append("action", "updateArticle");
        query.append("id", id);
        query.append("author", author);
        query.append("title", title);
        query.append("date", date);
        query.append("imageFile", imageFile);
        query.append("url", url);
        ajaxPost("index.php", query, function(response){
            $(articlesHandler.workLocation).html("").append($("<div>").html("L'article' " + title + " a été modifié."));
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
            articlesHandler.getArticles();
        });
    }

    //DELETE

    delete(id){
        if(confirm("Supprimer cet article ?")){
            let query = new FormData();
            query.append("action", "deleteArticle");
            query.append("id", id);
            ajaxPost("index.php", query, function(response){
                articlesHandler.getArticles();
            });
        }
    }

}
