<?php

class MembreController{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function insert($nom,$prenom,$idspecialite){ // Ajout de 'function' avant 'insert'
        try {
            $sql = "INSERT INTO membre (nom,prenom,idspecialite) VALUES (:nom,:prenom,:idspecialite)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':idspecialite', $idspecialite);
            $stmt->execute();
            return true; // Renvoie true si l'insertion réussie
        } catch (Exception $e) {
            // Gestion des erreurs
            die('Erreur lors de l\'insertion : ' . $e->getMessage());
        }
    }

    public function getAll(){
        try{
            $sql="SELECT * FROM membre m JOIN specialite s ON m.idspecialite = s.idspecialite ";
            $query_resultat = $this->pdo->query($sql);
            $resultat = $query_resultat->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;

        }catch(Exception $e){
            die('Erreur lors de la requete select: ' . $e->getMessage());
        }
    }
}
?>
