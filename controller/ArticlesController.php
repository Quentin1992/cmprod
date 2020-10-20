<?php
class ArticlesController extends ArticlesManager{

    private $targetDirectory = "public/images/frontend/articles/";

    public function addArticle($author, $title, $date, $imageFile, $url){
        $fileName = pathinfo($imageFile["name"],PATHINFO_FILENAME);
        $fileType = pathinfo($imageFile["name"],PATHINFO_EXTENSION);
        $targetFilePath = $this->targetDirectory . $fileName . ".webp";
        if ($fileType == 'jpeg' || $fileType == 'jpg')
            $image = imagecreatefromjpeg($imageFile['tmp_name']);
	    elseif ($fileType == 'gif')
            $image = imagecreatefromgif($imageFile['tmp_name']);
	    elseif ($fileType == 'png')
            $image = imagecreatefrompng($imageFile['tmp_name']);
        imagewebp($image, $targetFilePath, 100);
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
                'imageFile' => $article->imageFile(),
                'url' => $article->url()
            );
        }
        return json_encode($articlesData);
    }

    public function updateArticle($id, $author, $title, $date, $imageFile, $url){
        $fileName = pathinfo($imageFile["name"],PATHINFO_FILENAME);
        $fileType = pathinfo($imageFile["name"],PATHINFO_EXTENSION);
        $targetFilePath = $this->targetDirectory . $fileName . ".webp";
        if ($fileType == 'jpeg' || $fileType == 'jpg')
            $image = imagecreatefromjpeg($imageFile['tmp_name']);
	    elseif ($fileType == 'gif')
            $image = imagecreatefromgif($imageFile['tmp_name']);
	    elseif ($fileType == 'png')
            $image = imagecreatefrompng($imageFile['tmp_name']);
        imagewebp($image, $targetFilePath, 100);
        $article = new Article($id, $author, $title, $date, $targetFilePath, $url);
        $this->sendArticleUpdate($article);
    }

    public function deleteArticle($id){
        $this->sendArticleDeletion($id);
    }

}
