<?php 
    require_once("connexion.php");
    require_once("controller/partenaireController.php");
    $partenaire_controller = new PartenaireController($pdo);
    

    $liste_partenaire = $partenaire_controller->getAll();
    if(isset($_POST["type"])){
        if($_POST["type"] == "partenaire"){
            
            $partenaire_controller->insert($_POST["nom_partenaire"],$_POST["description_partenaire"]);

            header("location:index.php");
            exit();
        }
    }






?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Gestion Projet</title>
        <meta content='text/html; charset=UTF-8' />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    </head>
    <body class="bg-light">
   
        <div class='container mt-2'>
            <h2 class='bg-success text-center text-white p-1 rounded'>Gestion Projet</h2>
            <div class="row">
                <div class="col-sm-2">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#monpartenaire">Partenaire</button>
                    <div class="modal fade" id="monpartenaire">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Partenaire</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="type" value="partenaire">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm" name="nom_partenaire" id="" placeholder="Nom">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm" name="description_partenaire" id="" placeholder="Déscription">
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
                                                <button type="button" class="btn btn-dark btn-sm">Annuler</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered mt-3">
                                                <thead>
                                                    <th>*</th>
                                                    <th>Partenaire</th>
                                                    <th>Description</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($liste_partenaire as $key => $value){
                                                            echo "<tr>";
                                                            echo "<td>".$value["idpartenaire"]."</td>";
                                                            echo "<td>".$value["nom"]."</td>";
                                                            echo "<td>".$value["description"]."</td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
                                                    
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
            <hr>
            
        </div>
       
        <script>

           
        </script>

    </body>
</html>