<?php

class SpecialiteController{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function insert($intitule){ // Ajout de 'function' avant 'insert'
        try {
            $sql = "INSERT INTO specialite (intitule) VALUES (:intitule)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':intitule', $intitule);
            $stmt->execute();
            return true; // Renvoie true si l'insertion réussie
        } catch (Exception $e) {
            // Gestion des erreurs
            die('Erreur lors de l\'insertion : ' . $e->getMessage());
        }
    }

    public function getAll(){
        try{
            $sql="SELECT * FROM specialite";
            $query_resultat = $this->pdo->query($sql);
            $resultat = $query_resultat->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;

        }catch(Exception $e){
            die('Erreur lors de la requete select: ' . $e->getMessage());
        }
    }
}
?>
