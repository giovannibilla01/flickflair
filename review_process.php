<?php
    require_once ("globals.php");
    require_once ("db.php");
    require_once ("models/User.php");
    require_once ("models/Movie.php");
    require_once ("models/Review.php");
    require_once ("models/Message.php");
    require_once ("dao/UserDAO.php");
    require_once ("dao/MovieDAO.php");
    require_once ("dao/ReviewDAO.php");

    $user = new User();

    $movie = new Movie();

    $message = new Message($BASE_URL);

    $userDAO = new UserDAO($connection, $BASE_URL);
    
    $movieDAO = new MovieDAO($connection, $BASE_URL);

    $reviewDAO = new reviewDAO($connection, $BASE_URL);

    $userData = $userDAO->verifyToken();

    $type = filter_input(INPUT_POST, "type");

    if ($type == "create") {

        $rating = filter_input(INPUT_POST, "rating");
        $review = filter_input(INPUT_POST, "review");
        $movie_id = filter_input(INPUT_POST, "movies_id");
        $users_id = $userData->id;

        $reviewObject = new Review();

        $movieData = $movieDAO->findById($movie_id);

        if ($movieData) {

            if (!empty($rating) && !empty($review) && !empty($movie_id)) {

                $reviewObject->rating = $rating;
                $reviewObject->review = $review;
                $reviewObject->movies_id = $movie_id;
                $reviewObject->users_id = $users_id;

                $reviewDAO->create($reviewObject);

            } else {

                $message->setMessage("Necessario preencher todos os campos!", "error", "back");

            }

        } else {
            $message->setMessage("Informações Inválidas!", "error", "index.php");
        }
    
    } else {
        $message->setMessage("Informações Inválidas!", "error", "index.php");
    }

?>