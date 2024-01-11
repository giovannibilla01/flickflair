<?php
    require_once ("globals.php");
    require_once ("db.php");
    require_once ("models/User.php");
    require_once ("models/Movie.php");
    require_once ("models/Message.php");
    require_once ("dao/UserDAO.php");
    require_once ("dao/MovieDAO.php");

    $user = new User();

    $movie = new Movie();

    $message = new Message($BASE_URL);

    $userDAO = new UserDAO($connection, $BASE_URL);
    
    $movieDAO = new MovieDAO($connection, $BASE_URL);

    $userData = $userDAO->verifyToken();

    $type = filter_input(INPUT_POST, "type");

    if ($type == "create") {

        $title = filter_input(INPUT_POST, "title");
    
    }

?>