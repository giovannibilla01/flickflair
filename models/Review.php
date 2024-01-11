<?php
    class Review {

        public $id;
        public $rating;
        public $review;
        public $users_id;
        public $movies_id;
        
        public function imageGenerateName() {
            return bin2hex(random_bytes(60) . ".jpg");
        }
    }

    interface ReviewDAOInterface {

        public function buildReview($data);
        public function create(Review $review);
        //public function update(Review $review);
        //public function destroy(Review $review);
        //public function findAll();
        //public function findById($id);
        public function getMoviesReview($id);
        public function hasAlreadyReviewed($id, $userId);
        public function getRatings($id);
        
    }
?>