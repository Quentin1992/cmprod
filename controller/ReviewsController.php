<?php
class ReviewsController extends ReviewsManager{

    private $targetDirectory = "public/images/frontend/index/reviews/";

    public function addReview($author, $content, $imgLocation){
        $fileName = basename($imgLocation["name"]);
        $fileError = $imgLocation['error'];
        var_dump($fileError);
        $targetFilePath = $this->targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        move_uploaded_file($imgLocation['tmp_name'], $targetFilePath);
        $review = new Review(null, $author, $content, $targetFilePath);
        $this->sendReview($review);
    }

    public function getReviews(){
        $reviews = $this->goGetReviews();
        $reviewsData = [];
        foreach ($reviews as $review) {
            $reviewsData[] = $reviewData = array(
                'id' => $review->id(),
                'author' => $review->author(),
                'content' => $review->content(),
                'imgLocation' => $review->imgLocation()
            );
        }
        return json_encode($reviewsData);
    }

    public function updateReview($id, $author, $content, $imgLocation){
        $fileName = basename($imgLocation["name"]);
        $targetFilePath = $this->targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        move_uploaded_file($imgLocation['tmp_name'], $targetFilePath);
        $review = new Review($id, $author, $content, $targetFilePath);
        $this->sendReviewUpdate($review);
    }

    public function deleteReview($id){
        $this->sendReviewDeletion($id);
    }

}
