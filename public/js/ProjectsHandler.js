class ProjectsHandler {

    constructor(side, workLocation, displayLocation){
        this.workLocation = workLocation;
        this.displayLocation = displayLocation;
        this.side = side; //frontend or backend ?
        this.category = "all";
        this.projectsPerPage = 8;
        this.currentPage = 1;
    }

    //CREATE

    displayProjectForm(projectData){
        let projectForm = $("<form>", {action:"#"});
        let formTitle = $("<h3>");
        projectForm.append(formTitle);
        projectForm.append($("<label>", {for:"title", html:"Titre de la réalisation : "}));
        projectForm.append($("<input>", {type:"text", name:"title", required:true}));
        projectForm.append($("<label>", {for:"description", html:"Description : "}));
        projectForm.append($("<input>", {type:"text", name:"description", required:true}));
        projectForm.append($("<label>", {for:"imageFile", html:"Image de fond : "}));
        projectForm.append($("<input>", {type:"file", name:"imageFile", required:true}).on("change", function(e){
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
        $(projectsHandler.workLocation).html("");
        if(projectData != undefined){
            projectForm[0].title.value = projectData.title;
            projectForm[0].description.value = projectData.description;
            projectForm.children(":nth-child(5)").html("Modifier l'image actuelle : ");
            projectForm.children(":nth-child(5)").removeAttr("required");
            projectForm[0].url.value = projectData.url;
            projectForm[0].category.value = projectData.category;
            projectForm[0].submitButton.value = "Mettre à jour cette réalisation";
            formTitle.html("Modification de la réalisation sélectionnée");
        }
        else {
            formTitle.html("Création d'une réalisation");
        }
        projectForm.on("submit", function(e){
            $("form input[type='file']").after($("<p>").html("Chargement..."));
            if(projectData == undefined)
                projectsHandler.addProject(e.target.title.value, e.target.description.value, e.target.imageFile.files[0], e.target.url.value, e.target.category.value);
            else if(projectData != undefined)
                projectsHandler.updateProject(projectData.id, e.target.title.value, e.target.description.value, e.target.imageFile.files[0], e.target.url.value, e.target.category.value);
            e.preventDefault();
        });
        $(projectsHandler.workLocation).append(projectForm);
    }

    addProject(title, description, imageFile, url, category){
        var query = new FormData();
        query.append("action", "addProject");
        query.append("title", title);
        query.append("description", description);
        query.append("imageFile", imageFile);
        query.append("url", url);
        query.append("category", category);
        ajaxPost("index.php", query, function(response){
            $(projectsHandler.workLocation).html("").append($("<div>").html("La réalisation " + title + " a été ajoutée."));
            projectsHandler.getProjects(projectsHandler.currentPage);
        });
    }

    //READ

    countProjects(callback){
        let query = new FormData();
        query.append("action", "countProjects");
        query.append("category", projectsHandler.category);
        ajaxPost("index.php", query, function(response){
            callback(response);
        });
    }

    getProjects(pageNumber, callback){
        let query = new FormData();
        query.append("action", "getProjects");
        query.append("category", projectsHandler.category);
        query.append("pageNumber", pageNumber);
        query.append("projectsPerPage", projectsHandler.projectsPerPage);
        ajaxPost("index.php", query, function(response){
            let projects = JSON.parse(response);
            $(projectsHandler.displayLocation).html("");
            projectsHandler.countProjects(function(numberOfProjects){
                projectsHandler.displayProjects(projects, numberOfProjects);
            });
        });
    }

    displayProjects(projects, numberOfProjects){
        if(projects[0] != undefined){
            projects.forEach(function(projectData){
                let projectLink = $("<button>").attr("aria-label", "Voir la vidéo intitulée" + projectData.title).on("click", function(){
                    $("#video-modal").show();
                    $("#video-modal").append($("<iframe>").attr({
                        src: "https://www.youtube.com/embed/" + projectData.url.substring(32),
                        autoplay: "1",
                        allowfullscreen: "1"
                    }));
                    $("#video-modal").on("click", function(e){
                        e.target.innerHTML = "";
                        e.target.style.display = "none";
                    });
                });
                projectLink.append($("<img>").attr({
                    src: projectData.imageFile,
                    alt: "Image de la vidéo intitulée " + projectData.title
                }));
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
                        $("#form-modal").show();
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
            if(numberOfProjects > projectsHandler.projectsPerPage){
                let numberOfPages = Math.ceil(numberOfProjects / projectsHandler.projectsPerPage);
                let projectsNav = $("<div>", {id:"projectsNav"});
                projectsNav.append($("<button>").html("<").on("click", function(){
                    if(projectsHandler.currentPage > 1){
                        projectsHandler.currentPage --;
                        projectsHandler.getProjects(projectsHandler.currentPage);
                    }
                }));
                for(let i = 1; i <= (numberOfPages); i++){
                    projectsNav.append($("<span>").html(i).on("click", function(){
                        if(i != projectsHandler.currentPage){
                            projectsHandler.getProjects(i);
                            projectsHandler.currentPage = i;
                        }
                    }));
                }
                projectsNav.append($("<button>").html(">").on("click", function(){
                    if(projectsHandler.currentPage < numberOfPages){
                        projectsHandler.currentPage ++;
                        projectsHandler.getProjects(projectsHandler.currentPage);
                    }
                }));
                $("#projectsNav").remove();
                projectsNav.insertAfter($(projectsHandler.displayLocation));
                $("#projectsNav > span").css("color", "#4d4d4d");
                $("#projectsNav > span").css("font-weight", "600");
                $("#projectsNav > span:nth-child(" + (projectsHandler.currentPage + 1) + ")").css("color", "rgb(17,17,17)");
                $("#projectsNav > span:nth-child(" + (projectsHandler.currentPage + 1) + ")").css("font-weight", "900");
            }
            else $("#projectsNav").remove();
            if(projectsHandler.side == "backend"){
                $("html").animate({
                    scrollTop: $("#projectsButton").offset().top
                }, 1000);
            }
        }
        else $(projectsHandler.displayLocation).append($("<p>").html("Aucun projet pour le moment."));
    }

    //UPDATE

    updateProject(id, title, description, imageFile, url, category){
        var query = new FormData();
        query.append("action", "updateProject");
        query.append("id", id);
        query.append("title", title);
        query.append("description", description);
        query.append("imageFile", imageFile);
        query.append("url", url);
        query.append("category", category);
        ajaxPost("index.php", query, function(response){
            $(projectsHandler.workLocation).html("").append($("<div>").html("La réalisation " + title + " a été modifiée."));
            projectsHandler.getProjects(projectsHandler.currentPage);
        });
    }

    //DELETE

    delete(id){
        if(confirm("Supprimer cette réalisation ?")){
            let query = new FormData();
            query.append("action", "deleteProject");
            query.append("id", id);
            ajaxPost("index.php", query, function(response){
                projectsHandler.getProjects(projectsHandler.currentPage);
            });
        }
    }

}
