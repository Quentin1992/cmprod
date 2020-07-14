<?php
class ReviewsManager extends Database{

    //properties
    private $db;
    public function __construct(){
        $this->db = $this->setDbConnection();
    }

    public function sendReview($review){
        $sql = 'INSERT INTO reviews(review_author, review_content, review_img_location) VALUES(:author, :content, :imgLocation)';
        $query = $this->db->prepare($sql);
        $query->bindValue(':author', $review->author(), PDO::PARAM_STR);
        $query->bindValue(':content', $review->content(), PDO::PARAM_STR);
        $query->bindValue(':imgLocation', $review->imgLocation(), PDO::PARAM_STR);
        $query->execute();
    }

    public function goGetReviews(){
        $reviews = [];
        $sql = 'SELECT * FROM reviews';
        $query = $this->db->query($sql);
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $reviews[] = new Review($data['review_id'], $data['review_author'], $data['review_content'], $data['review_img_location']);
        }
        return $reviews;
    }

    public function sendReviewUpdate($review){
        $sql = 'UPDATE reviews SET review_author = :author, review_content = :content, review_img_location = :imgLocation WHERE review_id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':author', $review->author(), PDO::PARAM_STR);
        $query->bindValue(':content', $review->content(), PDO::PARAM_STR);
        $query->bindValue(':imgLocation', $review->imgLocation(), PDO::PARAM_STR);
        $query->bindValue(':id', $review->id(), PDO::PARAM_INT);
        $query->execute();
    }

    public function sendReviewDeletion($id){
        $query = $this->db->exec('DELETE FROM reviews WHERE review_id = ' . $id);
    }

}
