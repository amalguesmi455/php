<?php
class Demande {
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=animaux', 'root', '');
    }

    // Fetch all orders
    public function getAllDemandesEncours() {
        $query ="SELECT demande.id, user.nom AS user_name, animal.nom AS animal_name, demande.etat
        FROM demande
        JOIN user ON demande.idUser = user.id
        JOIN animal ON demande.idAnimal = animal.id
        WHERE demande.etat = 'pending'";


        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  // Fetch all orders
    public function getAllDemandesAccepted() {
    $query ="SELECT demande.id, user.nom AS user_name, animal.nom AS animal_name, demande.etat
    FROM demande
    JOIN user ON demande.idUser = user.id
    JOIN animal ON demande.idAnimal = animal.id
    WHERE demande.etat = 'accepted'";


    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getAllDemandesRefused() {
    $query ="SELECT demande.id, user.nom AS user_name, animal.nom AS animal_name, demande.etat
    FROM demande
    JOIN user ON demande.idUser = user.id
    JOIN animal ON demande.idAnimal = animal.id
    WHERE demande.etat = 'refused'";


    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


 // Fetch all orders
 public function getAllDemandes() {
    $query ="SELECT demande.id, user.nom AS user_name, animal.nom AS animal_name, demande.etat
    FROM demande
    JOIN user ON demande.idUser = user.id
    JOIN animal ON demande.idAnimal = animal.id";


    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Fetch a single order by ID
    public function getDemandeById($id) {
        $query = "SELECT * FROM demande WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update the status of an order (accept or refuse)
    public function updateDemandeStatus($id, $etat) {
        $query = "UPDATE demande SET etat = :etat WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':etat', $etat, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
