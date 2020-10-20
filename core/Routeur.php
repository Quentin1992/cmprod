<?php
class Routeur{

    private $revewsController;
    private $projectsController;
    private $articlesController;
    private $indexController;
    private $contactsController;

    public function __construct(){
        $this->reviewsController = new ReviewsController();
        $this->projectsController = new ProjectsController();
        $this->articlesController = new ArticlesController();
        $this->indexController = new IndexController();
        $this->contactsController = new ContactsController();
    }

    public function routeQuery(){
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                //REVIEWS ACTIONS
                case 'addReview':
                    $this->reviewsController->addReview($_POST['author'], $_POST['content'], $_FILES['imageFile']);
                    break;
                case 'getReviews':
                    echo $this->reviewsController->getReviews();
                    break;
                case 'updateReview':
                    $this->reviewsController->updateReview($_POST['id'], $_POST['author'], $_POST['content'], $_FILES['imageFile']);
                    break;
                case 'deleteReview':
                    $this->reviewsController->deleteReview($_POST['id']);
                    break;
                //PROJECTS ACTIONS
                case 'addProject':
                    $this->projectsController->addProject($_POST['title'], $_POST['description'], $_FILES['imageFile'], $_POST['url'], $_POST['category']);
                    break;
                case 'countProjects':
                    echo $this->projectsController->countProjects($_POST['category']);
                    break;
                case 'getProjects':
                    echo $this->projectsController->getProjects($_POST['category'], $_POST['pageNumber'], $_POST['projectsPerPage']);
                    break;
                case 'updateProject':
                    $this->projectsController->updateProject($_POST['id'], $_POST['title'], $_POST['description'], $_FILES['imageFile'], $_POST['url'], $_POST['category']);
                    break;
                case 'deleteProject':
                    $this->projectsController->deleteProject($_POST['id']);
                    break;
                //ARTICLES ACTIONS
                case 'addArticle':
                    $this->articlesController->addArticle($_POST['author'], $_POST['title'], $_POST['date'], $_FILES['imageFile'], $_POST['url']);
                    break;
                case 'getArticles':
                    echo $this->articlesController->getArticles();
                    break;
                case 'updateArticle':
                    $this->articlesController->updateArticle($_POST['id'], $_POST['author'], $_POST['title'], $_POST['date'], $_FILES['imageFile'], $_POST['url']);
                    break;
                case 'deleteArticle':
                    $this->articlesController->deleteArticle($_POST['id']);
                    break;
                //CONTACT ACTIONS
                case 'sendEmail':
                    $this->contactsController->sendEmail($_POST['name'], $_POST['phoneNumber'], $_POST['email'], $_POST['message'], $_POST['consent']);
                    break;
                default:
                    break;
            }
        }
        elseif(isset($_GET['action'])){
            switch($_GET['action']){
                case 'projectsView':
                    $this->indexController->projectsView();
                    break;
                case 'skillsView':
                    $this->indexController->skillsView();
                    break;
                case 'articlesView':
                    $this->indexController->articlesView();
                    break;
                case 'contactView':
                    $this->indexController->contactView();
                    break;
                case 'backendView':
                    $this->indexController->backendView();
                    break;
                case 'privacyView':
                    $this->indexController->privacyView();
                    break;
                default:
                    break;
            }
        }
        else{
            $this->indexController->indexView();
        }
    }
}
