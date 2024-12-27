<?php

class Reservation {
    private $cnx;

    public function __construct($dbConnection) {
        $this->cnx = $dbConnection;
    }

    public function createReservation($clientId, $activityId, $reservationDate) {
        $status = "En attente";
        $sql = $this->cnx->prepare("INSERT INTO reservation(id_client, id_activite, date_reservation, statut) 
                                    VALUES(:client, :activite, :date, :statut)");

        $sql->bindParam(":client", $clientId);
        $sql->bindParam(":activite", $activityId);
        $sql->bindParam(":date", $reservationDate);
        $sql->bindParam(":statut", $status);

        return $sql->execute();
    }

    public function getReservationsByClient($clientId, $search = null) {
        if ($search) {
            $sql = $this->cnx->prepare("SELECT * FROM reservation 
                                        INNER JOIN activite ON reservation.id_activite = activite.id_activite 
                                        WHERE id_client = :clientId AND titre LIKE :search");
            $searchTerm = "%" . $search . "%";
            $sql->bindParam(":search", $searchTerm);
        } else {
            $sql = $this->cnx->prepare("SELECT * FROM reservation 
                                        INNER JOIN activite ON reservation.id_activite = activite.id_activite 
                                        WHERE id_client = :clientId");
        }
        $sql->bindParam(":clientId", $clientId);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeReservation($reservationId) {
        $sql = $this->cnx->prepare("DELETE FROM reservation WHERE id_reservation = :reservationId");
        $sql->bindParam(":reservationId", $reservationId);
        return $sql->execute();
    }
}
?>
