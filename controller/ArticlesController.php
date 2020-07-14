<?php
class ArticlesController extends ArticlesManager{

    private $targetDirectory = "public/images/frontend/articles/";

    public function addArticle($author, $title, $date, $logoLocation, $url){
        $fileName = basename($logoLocation["name"]);
        $targetFilePath = $this->targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        move_uploaded_file($logoLocation['tmp_name'], $targetFilePath);
        $article = new Article(null, $author, $title, $date, $targetFilePath, $url);
        $this->sendArticle($article);
    }

    public function getArticles(){
        $articles = $this->goGetArticles();
        $articlesData = [];
        foreach ($articles as $article) {
            $articlesData[] = $articleData = array(
                'id' => $article->id(),
                'author' => $article->author(),
                'title' => $article->title(),
                'date' => $article->date(),
                'logoLocation' => $article->logoLocation(),
                'url' => $article->url()
            );
        }
        return json_encode($articlesData);
    }

    public function updateArticle($id, $author, $title, $date, $logoLocation, $url){
        $fileName = basename($logoLocation["name"]);
        $targetFilePath = $this->targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        move_uploaded_file($logoLocation['tmp_name'], $targetFilePath);
        $article = new Article($id, $author, $title, $date, $targetFilePath, $url);
        $this->sendArticleUpdate($article);
    }

    public function deleteArticle($id){
        $this->sendArticleDeletion($id);
    }

}
