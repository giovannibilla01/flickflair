<?php
    require_once ("models/User.php");
    require_once ("models/Message.php");

    class UserDAO implements UserDAOInterface {

        private $connection;
        private $url;
        private $message;

        public function __construct(PDO $connection, $url) 
        {
             $this->connection = $connection;
             $this->url = $url;
             $this->message = new Message($url);
        }

        public function buildUser($data) {

            $user = new User();

            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->lastname = $data['lastname'];
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->image = $data['image'];
            $user->bio = $data['bio'];
            $user->token = $data['token'];

            return $user;
        }

        public function create(User $user, $authUser = false) {
            $query = "INSERT INTO users(
                    name,
                    lastname,
                    email,
                    password,
                    token
                ) VALUES (
                    :name,
                    :lastname,
                    :email,
                    :password,
                    :token
                )";

            $stmt = $this->connection->prepare($query);

            $stmt->bindParam(":name", $user->name);
            $stmt->bindParam(":lastname", $user->lastname);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":password", $user->password);
            $stmt->bindParam(":token", $user->token);

            $stmt->execute();

            if ($authUser) {
                $this->setTokenToSession($user->token);
            }
        }

        public function update(User $user) {

        }

        public function verifyToken($protected = false) {

        }

        public function setTokenToSession($token, $redirect = true) {
            $_SESSION['token'] = $token;

            if ($redirect) {
                $this->message->setMessage("Seja Bem Vindo", "success", "editprofile.php");
            }
        }

        public function authenticateUser($email, $password) {

        }

        public function findByEmail($email) {
            if ($email != null) {
                $query = "SELECT * FROM users WHERE email = :email";
                
                $stmt = $this->connection->prepare($query);

                $stmt->bindParam(":email", $email);

                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);
                    return $user;
                } else {
                    return false;
                }

            } else {
                return false;
            }
        }

        public function findById($id) {

        }

        public function findByToken($token) {

        }

        public function changePassword(User $user) {

        }


    }
?>