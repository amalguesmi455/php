<?php

class Animal
{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=animaux', 'root', '');
    }

    public function listeAnimals(){
        return $this->db->query("SELECT * FROM Animal");
    }

    public function addAnimal($data, $imagePath){
        $nom = $data['nom'];
        $categorie = $data['categorie'];
        $age = $data['age'];
        $description = $data['description'];
        $prix = $data['prix'];
        $image = $imagePath;

        $query = "INSERT INTO Animal (nom, categorie, age, description, prix, image) 
                  VALUES ('$nom', '$categorie', '$age', '$description', '$prix', '$image')";

        $this->db->exec($query);
    }

    public function deleteAnimal($id){
        $this->db->exec("DELETE FROM Animal WHERE id='$id'");
    }

    public function getAnimalById($id){
        return $this->db->query("SELECT * FROM Animal WHERE id='$id'")->fetch();
    }

    public function countAnimals(){
        return $this->db->query("SELECT COUNT(*) as nbre FROM Animal")->fetch();
    }

    public function editAnimal($id, $data, $imagePath = null){
        $query = "UPDATE Animal SET nom = :nom, categorie = :categorie, age = :age, 
                  description = :description, prix = :prix" . ($imagePath ? ", image = :image" : "") . " WHERE id = :id";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':categorie', $data['categorie']);
        $stmt->bindParam(':age', $data['age']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':prix', $data['prix']);
        if ($imagePath) {
            $stmt->bindParam(':image', $imagePath);
        }
        $stmt->bindParam(':id', $id);
    
        if ($stmt->execute()) {
            echo "Animal updated successfully!";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
    
}
