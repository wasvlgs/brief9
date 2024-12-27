<?php

function checkUserSession($cnx) {
    if (!isset($_SESSION['id'])) {
        session_destroy();
        echo '<script>location.replace("../login/login.php")</script>';
        exit;
    }

    $getId = $_SESSION['id'];
    $getUser = $cnx->prepare("SELECT * FROM client WHERE id_client = :id");
    $getUser->bindParam(":id", $getId);
    $getUser->execute();
    
    return $getUser->fetch(PDO::FETCH_ASSOC);
}

function deleteUser($cnx, $userId) {
    $sql = $cnx->prepare("DELETE FROM client WHERE id_client = :id");
    $sql->bindParam(":id", $userId);
    $sql->execute();
}

function blockUser($cnx, $userId) {
    $sql = $cnx->prepare("UPDATE client SET status = 'banned' WHERE id_client = :id");
    $sql->bindParam(":id", $userId);
    $sql->execute();
}

function fetchUsers($cnx, $searchTerm = '') {
    if ($searchTerm) {
        $sql = $cnx->prepare("SELECT * FROM client WHERE role != 'sAdmin' AND (nom LIKE :term OR prenom LIKE :term)");
        $sql->bindValue(':term', "%$searchTerm%");
    } else {
        $sql = $cnx->prepare("SELECT * FROM client WHERE role != 'sAdmin'");
    }

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>
