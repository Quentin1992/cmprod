<?php
class ArticlesManager extends Database{

    //properties
    private $db;
    public function __construct(){
        $this->db = $this->setDbConnection();
    }

    public function sendArticle($article){
        $sql = 'INSERT INTO articles(article_author, article_title, article_date, article_logo_location, article_url) VALUES(:author, :title, :date, :logoLocation, :url)';
        $query = $this->db->prepare($sql);
        $query->bindValue(':author', $article->author(), PDO::PARAM_STR);
        $query->bindValue(':title', $article->title(), PDO::PARAM_STR);
        $query->bindValue(':date', $article->date(), PDO::PARAM_STR);
        $query->bindValue(':logoLocation', $article->logoLocation(), PDO::PARAM_STR);
        $query->bindValue(':url', $article->url(), PDO::PARAM_STR);
        $query->execute();
    }

    public function goGetArticles(){
        $articles = [];
        $dateQuery = $this->db->query("SET lc_time_names = 'fr_FR'");
        $dateQuery->execute();
        $sql = 'SELECT article_id, article_author, article_title, article_date, article_logo_location, article_url FROM articles';
        $query = $this->db->query($sql);
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $articles[] = new Article($data['article_id'], $data['article_author'], $data['article_title'], $data['article_date'], $data['article_logo_location'], $data['article_url']);
        }
        return $articles;
    }

    public function sendArticleUpdate($article){
        $sql = 'UPDATE articles SET article_author = :author, article_title = :title, article_date = :date, article_logo_location = :logoLocation, article_url = :url WHERE article_id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':author', $article->author(), PDO::PARAM_STR);
        $query->bindValue(':title', $article->title(), PDO::PARAM_STR);
        $query->bindValue(':date', $article->date(), PDO::PARAM_STR);
        $query->bindValue(':logoLocation', $article->logoLocation(), PDO::PARAM_STR);
        $query->bindValue(':url', $article->url(), PDO::PARAM_STR);
        $query->bindValue(':id', $article->id(), PDO::PARAM_INT);
        $query->execute();
    }

    public function sendArticleDeletion($id){
        $query = $this->db->exec('DELETE FROM articles WHERE article_id = ' . $id);
    }

}
