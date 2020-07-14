class ProjectsHandler {

    constructor(side, workLocation, displayLocation){
        this.workLocation = workLocation;
        this.displayLocation = displayLocation;
        this.side=side; //frontend or backend ?
    }

    //CREATE

    displayNewProjectButton(){
        $(projectsHandler.workLocation).append($("<button>").html("Ajouter une nouvelle réalisation").on("click", function(e){
            $(projectsHandler.workLocation).html("");
            projectsHandler.displayProjectForm();
        }));
    }

    displayProjectForm(projectData){
        let projectForm = $("<form>", {action:"#"});
        projectForm.append($("<label>", {for:"title", html:"Titre de la réalisation : "}));
        projectForm.append($("<input>", {type:"text", name:"title", required:true}));
        projectForm.append($("<label>", {for:"description", html:"Description : "}));
        projectForm.append($("<input>", {type:"text", name:"description", required:true}));
        projectForm.append($("<label>", {for:"imgLocation", html:"Image de fond : "}));
        projectForm.append($("<input>", {type:"file", name:"imgLocation", required:true}).on("change", function(e){
            $("#formImgDiv").remove();
            let image = $("<img>").attr("src", window.URL.createObjectURL(e.target.files[0]));
            $("<div>", {
                id:"formImgDiv"
            }).append(image).insertAfter($(this));
        }));
        projectForm.append($("<label>", {for:"url", html:"Lien vers la réalisation : "}));
        projectForm.append($("<input>", {type: "text", name:"url", required:true}));
        projectForm.append($("<label>", {for:"category", html:"Type de réalisation : "}));
        let selectCategory = $("<select>").attr("name", "category");
        selectCategory.append($("<option>", {value:"video", html:"vidéo"}));
        selectCategory.append($("<option>", {value:"motionDesign", html:"motion design"}));
        projectForm.append(selectCategory);
        projectForm.append($("<input>", {type:"submit", name:"submitButton", value:"Ajouter cette réalisation"}));
        projectForm.append($("<button>").html("Annuler").on("click", function(){
            $(projectsHandler.workLocation).html("");
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
        }));
        $(projectsHandler.workLocation).html("");
        if(projectData != undefined){
            projectForm[0].title.value = projectData.title;
            projectForm[0].description.value = projectData.description;
            projectForm.children(":nth-child(5)").html("Modifier l'image actuelle : ");
            projectForm.children(":nth-child(5)").removeAttr("required");
            projectForm[0].url.value = projectData.url;
            projectForm[0].category.value = projectData.category;
            projectForm[0].submitButton.value = "Mettre à jour cette réalisation";
            $(reviewsHandler.workLocation).append($("<h3>").html("Modification de la réalisation sélectionnée"));
        }
        else {
            $(projectsHandler.workLocation).append($("<h3>").html("Création d'une réalisation"));
        }
        projectForm.on("submit", function(e){
            if(projectData == undefined)
                projectsHandler.addProject(e.target.title.value, e.target.description.value, e.target.imgLocation.files[0], e.target.url.value, e.target.category.value);
            else if(projectData != undefined)
                projectsHandler.updateProject(projectData.id, e.target.title.value, e.target.description.value, e.target.imgLocation.files[0], e.target.url.value, e.target.category.value);
            e.preventDefault();
        });
        $(projectsHandler.workLocation).append(projectForm);
    }

    addProject(title, description, imgLocation, url, category){
        var query = new FormData();
        query.append("action", "addProject");
        query.append("title", title);
        query.append("description", description);
        query.append("imgLocation", imgLocation);
        query.append("url", url);
        query.append("category", category);
        ajaxPost("index.php", query, function(response){
            $(projectsHandler.workLocation).html("").append($("<div>").html("La réalisation " + title + " a été ajoutée."));
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
            projectsHandler.getProjects();
        });
    }

    //READ

    getProjects(category){
        let query = new FormData();
        query.append("action", "getProjects");
        query.append("category", category);
        ajaxPost("index.php", query, function(response){
            console.log(response);
            let projects = JSON.parse(response);
            $(projectsHandler.displayLocation).html("");
            projectsHandler.displayProjects(projects);
        });
    }

    displayProjects(projects){
        if(projects[0] != undefined){
            projects.forEach(function(projectData){
                let projectLink = $("<a>").attr("href", projectData.url);
                projectLink.append($("<img>").attr("src", projectData.imgLocation));
                let hiddenDiv = $("<div>");
                hiddenDiv.append($("<h3>").html(projectData.title));
                hiddenDiv.append($("<p>").html(projectData.description));
                hiddenDiv.append($("<div>").append($("<i>").attr("class", "fas fa-caret-right")));
                projectLink.append(hiddenDiv);
                if(projectsHandler.side == "frontend"){
                    $(projectsHandler.displayLocation).append($("<div>").append(projectLink));
                }
                else {
                    let adminDiv = $("<div>");
                    let buttonsDiv = $("<div>");
                    buttonsDiv.append($("<button>").html("Modifier").on("click", function(){
                        projectsHandler.displayProjectForm(projectData);
                    }));
                    buttonsDiv.append($("<button>").html("Supprimer").on("click", function(){
                        projectsHandler.delete(projectData.id);
                    }));
                    adminDiv.append(projectLink);
                    adminDiv.append(buttonsDiv);
                    $(projectsHandler.displayLocation).append(adminDiv);
                }
            });
        }
        else $(projectsHandler.displayLocation).append($("<p>").html("Aucun projet pour le moment."));
    }

    //UPDATE

    updateProject(id, title, description, imgLocation, url, category){
        var query = new FormData();
        query.append("action", "updateProject");
        query.append("id", id);
        query.append("title", title);
        query.append("description", description);
        query.append("imgLocation", imgLocation);
        query.append("url", url);
        query.append("category", category);
        ajaxPost("index.php", query, function(response){
            $(projectsHandler.workLocation).html("").append($("<div>").html("La réalisation " + title + " a été modifiée."));
            reviewsHandler.displayNewReviewButton();
            projectsHandler.displayNewProjectButton();
            articlesHandler.displayNewArticleButton();
            projectsHandler.getProjects();
        });
    }

    //DELETE

    delete(id){
        if(confirm("Supprimer cette réalisation ?")){
            let query = new FormData();
            query.append("action", "deleteProject");
            query.append("id", id);
            ajaxPost("index.php", query, function(response){
                projectsHandler.getProjects();
            });
        }
    }

}
