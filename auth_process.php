<?php

    require_once ("globals.php");
    require_once ("db.php");
    require_once ("models/User.php");
    require_once ("models/Message.php");
    require_once ("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $userDAO = new UserDAO($connection, $BASE_URL);

    $user = new User();

    $type = filter_input(INPUT_POST, "type");

    if ($type == "register") {

        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

        if ($name && $lastname && $email && $password) {

            if($password == $confirmpassword) {

                if ($userDAO->findByEmail($email) == false) {
                    $userToken = $user->generateToken();
                    $finalPassword = $user->generatePassword($password);

                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPassword;
                    $user->token = $userToken;
                    
                    $auth = true;

                    $userDAO->create($user, $auth);
                } else {
                    $message->setMessage("Email já cadastrado no sistema", "error", "back");
                }

            } else {
                $message->setMessage("As senhas não são iguais", "error", "back");
            }

        } else {

            $message->setMessage("Por favor, preencha todos os campos", "error", "back");

        }

    } elseif ($type == "login") {
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        
        if ($userDAO->authenticateUser($email, $password)) {
            $message->setMessage("Seja Bem-Vindo", "success", "editprofile.php");
        } else {
            $message->setMessage("Usuario e/ou senha incorretos", "error", "back");
        }
    } else {
        $message->setMessage("Dados inválidos", "error", "index.php");
    }
?>