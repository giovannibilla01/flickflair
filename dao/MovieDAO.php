<?php
    require_once ("models/Movie.php");
    require_once ("models/Message.php");

    class MovieDAO implements MovieDAOInterface {
        
        private $connection;
        private $url;
        private $message;

        public function __construct(PDO $connection, $url) {
            $this->connection = $connection;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildMovie($data) {
            $movie = new Movie();

            $movie->id = $data['id'];
            $movie->title = $data['title'];
            $movie->description = $data['description'];
            $movie->image = $data['image'];
            $movie->trailer = $data['trailer'];
            $movie->category = $data['category'];
            $movie->length = $data['length'];
            $movie->users_id = $data['users_id'];

            return $movie;
        }
        public function create(Movie $movie) {

            $query = "INSERT INTO movies (
                title, description, image, trailer, category, length, users_id
            ) VALUES (
                :title, :description, :image, :trailer, :category, :length, :users_id
            )";

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(":title", $movie->title);
            $stmt->bindParam(":description", $movie->description);
            $stmt->bindParam(":image", $movie->image);
            $stmt->bindParam(":trailer", $movie->trailer);
            $stmt->bindParam(":category", $movie->category);
            $stmt->bindParam(":length", $movie->length);
            $stmt->bindParam(":users_id", $movie->users_id);

            $stmt->execute();

            $this->message->setMessage("Dados Inseridos com sucesso","success","index.php");

        }
        public function update(Movie $movie) {

        }
        public function destroy(Movie $movie) {

        }
        public function findAll() {

        }
        public function findById($id) {

        }
        public function findByTitle($title) {

        }
        public function getLastestMovies() {

        }
        public function getMoviesByCategory($category) {

        }
        public function getMoviesByUserId($id) {

        }
    }
?>