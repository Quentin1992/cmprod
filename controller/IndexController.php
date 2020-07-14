<?php
class IndexController {

    public function indexView(){
        $view = new View();
        $view->render('indexView');
    }
    public function projectsView(){
        $view = new View();
        $view->render('projectsView');
    }
    public function skillsView(){
        $view = new View();
        $view->render('skillsView');
    }
    public function articlesView(){
        $view = new View();
        $view->render('articlesView');
    }
    public function contactView(){
        $view = new View();
        $view->render('contactView');
    }
    public function backendView(){
        $view = new View();
        $view->render('backendView');
    }

    public function privacyView(){
        $view = new View();
        $view->render('privacyView');
    }
}
