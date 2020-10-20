<?php
class ReviewsController extends ReviewsManager{

    private $targetDirectory = "public/images/frontend/index/reviews/";

    public function addReview($author, $content, $imageFile){
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
                'imageFile' => $review->imageFile()
            );
        }
        return json_encode($reviewsData);
    }

    public function updateReview($id, $author, $content, $imageFile){
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
        $review = new Review($id, $author, $content, $targetFilePath);
        $this->sendReviewUpdate($review);
    }

    public function deleteReview($id){
        $this->sendReviewDeletion($id);
    }

}
