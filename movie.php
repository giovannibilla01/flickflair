<?php
    require_once ("templates/header.php");

    $id = filter_input(INPUT_GET, "id");

    $movie;

    if (empty($id)) {
        $message->setMessage("O filme não foi encontrado!", "error", "index.php");
    } else {

        $movie = $movieDAO->findById($id);

        if (!$movie) {
            $message->setMessage("O filme não foi encontrado!", "error", "index.php");
        }
    }

    $userOwnsMovie = false;

    if (!empty($userData)) {
        if ($userData->id === $movie->users_id) {
            $userOwnsMovie = true;
        }
    }
?>