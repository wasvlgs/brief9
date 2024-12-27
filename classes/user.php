<?php

class User {
    private $cnx;

    public function __construct($dbConnection) {
        $this->cnx = $dbConnection;
    }

    public function login($email, $password) {
        $sql = $this->cnx->prepare("SELECT * FROM client WHERE email = :email");
        $sql->bindParam(":email", $email);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        if ($sql->rowCount() === 1 && password_verify($password, $user['password']) && $user['status'] == 'active') {
            $_SESSION['id'] = $user['id_client'];

            if ($user['role'] == "admin" || $user['role'] == "sAdmin") {
                return 'admin';
            } else if ($user['role'] == "client") {
                return 'client';
            }
        }
        return false;
    }

    public function signup($fname, $lname, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $checkEmail = $this->cnx->prepare("SELECT * FROM client WHERE email = :email");
        $checkEmail->bindParam(':email', $email);
        $checkEmail->execute();

        if ($checkEmail->rowCount() > 0) {
            return false; 
        }

        $sql = $this->cnx->prepare("INSERT INTO client (nom, prenom, email, password, role, status) VALUES (:fname, :lname, :email, :password, 'client', 'active')");
        $sql->bindParam(':fname', $fname);
        $sql->bindParam(':lname', $lname);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':password', $hashedPassword);

        if ($sql->execute()) {
            return true;
        }
        return false;
    }


    public function getUserById($userId) {
        $sql = $this->cnx->prepare("SELECT * FROM client WHERE id_client = :id");
        $sql->bindParam(":id", $userId);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}

?>
