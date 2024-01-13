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

            $query = "INSERT INTO reviews (
                rating, review, movies_id, users_id
            ) VALUES (
                :rating, :review, :movies_id, :users_id
            )";

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(":rating", $review->rating);
            $stmt->bindParam(":review", $review->review);
            $stmt->bindParam(":movies_id", $review->movies_id);
            $stmt->bindParam(":users_id", $review->users_id);

            $stmt->execute();

            $this->message->setMessage("Dados Inseridos com sucesso","success","index.php");

        }

        public function getMoviesReview($id) {

            $reviews = [];

            $query = "SELECT * FROM reviews WHERE movies_id = :movies_id";

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(":movies_id", $id);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $reviewsData = $stmt->fetchAll();

                $userDao = new UserDAO($this->connection, $this->url);

                foreach ($reviewsData as $review) {
                    $reviewObject = $this->buildReview($review);

                    $user = $userDao->findById($reviewObject->users_id);

                    $reviews[] = ["review" => $reviewObject, "user" => $user];
                }
            }

            return $reviews;

        }

        public function hasAlreadyReviewed($id, $userId) {

        }

        public function getRatings($id) {

        }

    }

?>