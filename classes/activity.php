<?php

class Activity {
    private $cnx;

    public function __construct($dbConnection) {
        $this->cnx = $dbConnection;
    }

    public function getActivities($search = null) {
        $sql = $this->cnx->prepare("SELECT * FROM activite WHERE titre LIKE :search");
        $searchTerm = "%" . $search . "%";
        $sql->bindParam(":search", $searchTerm);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateActivity($id, $titre, $description, $destination, $prix, $dateS, $dateE, $placesDisponibles) {
        $sql = $this->cnx->prepare("UPDATE activite SET titre = :titre, description = :description, destination = :destination, prix = :prix, date_debut = :dateS, date_fin = :dateE, places_disponibles = :placesDisponibles WHERE id_activite = :id");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':titre', $titre);
        $sql->bindParam(':description', $description);
        $sql->bindParam(':destination', $destination);
        $sql->bindParam(':prix', $prix);
        $sql->bindParam(':dateS', $dateS);
        $sql->bindParam(':dateE', $dateE);
        $sql->bindParam(':placesDisponibles', $placesDisponibles);
        $sql->execute();
    }

    public function deleteActivity($id) {
        $sql = $this->cnx->prepare("DELETE FROM activite WHERE id_activite = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
    }
}
?>
