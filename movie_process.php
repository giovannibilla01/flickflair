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
        $description = filter_input(INPUT_POST, "description");
        $trailer = filter_input(INPUT_POST, "trailer");
        $category = filter_input(INPUT_POST, "category");
        $length = filter_input(INPUT_POST, "length");

        if (!empty($title) && !empty($description) && !empty($category)) {

            $movie->title = $title;
            $movie->description = $description;
            $movie->trailer = $trailer;
            $movie->category = $category;
            $movie->length = $length;
            $movie->users_id = $userData->id;

            if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
                $image = $_FILES['image'];
                $imageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                $jpgArray = ['image/jpeg', 'image/jpg'];
    
                if (in_array($image['type'], $imageTypes)) {
                    if (in_array($image['type'], $jpgArray)) {
                        $imageFile = imageCreateFromJpeg($image['tmp_name']);
                    } else {
                        $imageFile = imagecreatefrompng($image['tmp_name']);
                    }
    
                    $imageName = $movie->imageGenerateName();
    
                    imagejpeg($imageFile, "./img/movies/" . $imageName, 90);
    
                    $movie->image = $imageName;
                
                } else {
                    $message->setMessage("Tipo invalido de imagem!", "error", "back");
                }
            }

            $movieDAO->create($movie);

        } else {
            $message->setMessage("São necessarias mais informações sobre o filme!", "error", "back");
        }

    } else if ($type == "delete") {

        $id = filter_input(INPUT_POST, "id");

        $movie = $movieDAO->findById($id);

        if ($movie) {
            if ($movie->users_id == $userData->id) {
                $movieDAO->destroy($movie);
            } else {
                $message->setMessage("Informações Inválidas!", "error", "index.php");
            }
        } else {
            $message->setMessage("Informações Inválidas!", "error", "index.php");
        }
    } else if ($type == "update") {

        $id = filter_input(INPUT_POST, "id");
        $title = filter_input(INPUT_POST, "title");
        $description = filter_input(INPUT_POST, "description");
        $trailer = filter_input(INPUT_POST, "trailer");
        $category = filter_input(INPUT_POST, "category");
        $length = filter_input(INPUT_POST, "length");

        $movieData = $movieDAO->findById($id);

        if ($movieData) {

            if ($movieData->users_id == $userData->id) {
                
                if (!empty($title) && !empty($description) && !empty($category)) {

                $movieData->title = $title;
                $movieData->description = $description;
                $movieData->trailer = $trailer;
                $movieData->category = $category;
                $movieData->length = $length;
                
                if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
                    $image = $_FILES['image'];
                    $imageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
                    $jpgArray = ['image/jpeg', 'image/jpg'];
        
                    if (in_array($image['type'], $imageTypes)) {
                        if (in_array($image['type'], $jpgArray)) {
                            $imageFile = imageCreateFromJpeg($image['tmp_name']);
                        } else {
                            $imageFile = imagecreatefrompng($image['tmp_name']);
                        }
        
                        $imageName = $movie->imageGenerateName();
        
                        imagejpeg($imageFile, "./img/movies/" . $imageName, 90);
        
                        $movieData->image = $imageName;
                    
                    }
                }
    
                $movieDAO->update($movieData);

                } else {
                    $message->setMessage("São necessarias mais informações sobre o filme!", "error", "back");
                }

            } else {
                $message->setMessage("Informações Inválidas!", "error", "index.php");
            }

        } else {
            $message->setMessage("Informações Inválidas!", "error", "index.php");
        }
    } else {
        $message->setMessage("Informações Inválidas!", "error", "index.php");
    }

?>