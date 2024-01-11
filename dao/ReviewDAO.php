<?php
    require_once ("models/Review.php");
    require_once ("models/Message.php");

    require_once ("dao/UserDAO.php");

    class ReviewDAO implements ReviewDAOInterface {
        
        private $connection;
        private $url;
        private $message;

        public function __construct(PDO $connection, $url) {
            $this->connection = $connection;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildReview($data) {

            $reviewOcject = new Review();

            $reviewOcject->id = $data["id"];
            $reviewOcject->rating = $data["rating"];
            $reviewOcject->review = $data["review"];
            $reviewOcject->users_id = $data["users_id"];
            $reviewOcject->movies_id = $data["movies_id"];
            
            return $reviewOcject;
        }

        public function create(Review $review) {

        }

        public function getMoviesReview($id) {

        }

        public function hasAlreadyReviewed($id, $userId) {

        }

        public function getRatings($id) {

        }

    }

?>