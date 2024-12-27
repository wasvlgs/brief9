<?php

class Activity {
    private $cnx;

    public function __construct($dbConnection) {
        $this->cnx = $dbConnection;
    }

    public function getAllActivities($searchTerm = "") {
        if ($searchTerm) {
            $searchTerm = "%" . $searchTerm . "%";
            $sql = $this->cnx->prepare("SELECT * FROM activite WHERE titre LIKE :search");
            $sql->bindParam(":search", $searchTerm);
        } else {
            $sql = $this->cnx->prepare("SELECT * FROM activite");
        }

        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservationCount($activityId) {
        $sql = $this->cnx->prepare("SELECT COUNT(*) FROM reservation WHERE id_activite = :activityId");
        $sql->bindParam(":activityId", $activityId);
        $sql->execute();
        return $sql->fetchColumn();
    }
}
?>
