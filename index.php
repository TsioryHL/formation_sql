<?php 
    require_once("connexion.php");
    require_once("controller/partenaireController.php");
    require_once("controller/specialiteController.php");
    require_once("controller/membreController.php");

    $partenaire_controller = new PartenaireController($pdo);
    $specialite_controller = new SpecialiteController($pdo);
    $membre_controller = new MembreController($pdo);

    $liste_partenaire = $partenaire_controller->getAll();
    $liste_specialite = $specialite_controller->getAll();
    $liste_membre = $membre_controller->getAll();

    if(isset($_POST["type"])){
        $type = $_POST["type"];
        //PARTENAIRE
        if($type== "partenaire"){
            $nom_partenaire = $_POST["nom_partenaire"];
            $description_partenaire  = $_POST["description_partenaire"];
            $id_partenaire = $_POST["idpartenaire"];

            if(!empty($id_partenaire) && !is_null($id_partenaire)){
                //UPDATE
                if(!empty($nom_partenaire) && !empty($description_partenaire)){
                    $partenaire_controller->update($id_partenaire,$nom_partenaire,$description_partenaire);
                    header("location:index.php");
                    exit();
                }
            }else{
                if(!empty($nom_partenaire) && !empty($description_partenaire)){
                    $partenaire_controller->insert($nom_partenaire,$description_partenaire);
                    header("location:index.php");
                    exit();
                }
            }

            
        }

        //SPECIALITE
        if($type == "specialite"){
            if(!empty($_POST["intitule"])){
                $specialite_controller->insert($_POST["intitule"]);
                header("location:index.php");
                exit();
            }
        }

        //MEMBRE
        if($type == "membre"){
            $nom_membre = $_POST["nom_membre"];
            $prenom_membre  = $_POST["prenom_membre"];
            $id_specialite = $_POST["id_specialite_membre"];
            $id_membre =$_POST["idmembre"];
         
            if(!empty($id_membre) && !is_null($id_membre)){
                //UPDATE
              
                if(!empty($nom_membre) && !empty($prenom_membre) && !empty($id_specialite)){
                    $membre_controller->update($nom_membre,$prenom_membre,$id_specialite);
                    header("location:index.php");
                    exit();
                }
            }else{
                if(!empty($nom_membre) && !empty($prenom_membre) && !empty($id_specialite)){
                    $membre_controller->insert($nom_membre,$prenom_membre,$id_specialite);
                    header("location:index.php");
                    exit();
                }
            }
            

        }
    }






?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Gestion Projet</title>
        <meta content='text/html; charset=UTF-8' />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script/script.js" type="javascript"></script>
    </head>
    <body class="bg-light">
   
        <div class='container mt-2'>
            <h2 class='bg-success text-center text-white p-1 rounded'>Gestion Projet</h2>
            <div class="row">
                <div class="col-sm-12">

                    <button type="button" class="btn btn-primary btn-sm position-relative" data-bs-toggle="modal" data-bs-target="#monpartenaire" >
                    <i class="bi bi-plus"></i>
                    Partenaire
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo count($liste_partenaire) ?></span>
                    </button>
                    <div class="modal fade" id="monpartenaire">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Partenaire</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="type" value="partenaire">
                                        <input type="hidden" name="idpartenaire" id="idpartenaire" value="">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm" name="nom_partenaire" id="nom_partenaire" placeholder="Nom">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm" name="description_partenaire" id="description_partenaire" placeholder="Déscription">
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary btn-sm" id="btn_gest_partenaire" >Ajouter</button>
                                                <button type="button" class="btn btn-dark btn-sm" onclick="annulation_partenaire()">Annuler</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered mt-3 table-center">
                                                <thead>
                                                    <th>*</th>
                                                    <th>Partenaire</th>
                                                    <th>Description</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($liste_partenaire as $key => $value){
                                                            echo "<tr>";
                                                            echo "<td>".$value["idpartenaire"]."</td>";
                                                            echo "<td>".$value["nom"]."</td>";
                                                            echo "<td>".$value["description"]."</td>";
                                                            // Échappement des guillemets dans les valeurs pour éviter les erreurs JavaScript
                                                            $nom = addslashes($value["nom"]);
                                                            $description = addslashes($value["description"]);
                                                            $idPartenaire = $value["idpartenaire"];
                                                            echo "<td><button class='btn btn-sm btn-warning' onclick='getDetailUpdate(\"$nom\", \"$description\", $idPartenaire)'><i class='bi bi-save'></i></button></td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>

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
                    
                    <button type="button" class="btn btn-warning btn-sm position-relative ms-3" data-bs-toggle="modal" data-bs-target="#monspecialite" >
                    <i class="bi bi-journal-plus"></i>
                    Spécialité
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo count($liste_specialite) ?></span>
                    </button>
                    <div class="modal fade" id="monspecialite">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Spécialité</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="type" value="specialite">
                                        <input type="hidden" name="id_specialite" id="id_specialite" value="">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" name="intitule" id="intitule_specialite" placeholder="Intitulé">
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary btn-sm" id="btn_gest_specialite">Ajouter</button>
                                                <button type="button" class="btn btn-dark btn-sm" onclick="btn_annuler_specialite()">Annuler</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered mt-3">
                                                <thead>
                                                    <th>*</th>
                                                    <th>Intitulé</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($liste_specialite as $key => $value){
                                                            $intitule = addslashes($value["intitule"]);
                                                            $idspecialite = addslashes($value["idspecialite"]);
                                                            echo "<tr>";
                                                            echo "<td>".$idspecialite."</td>";
                                                            echo "<td>".$intitule."</td>";
                                                            echo "<td><button class='btn btn-warning btn-sm' onClick='getDetailUpdateSpecialite(\"$intitule\", $idspecialite)' ><i class='bi bi-pen'></i></button>";
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

                    <button type="button" class="btn btn-dark btn-sm position-relative ms-3" data-bs-toggle="modal" data-bs-target="#monmembre" >
                    <i class="bi bi-person-add"></i>
                    Membre
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo count($liste_membre) ?></span>
                    </button>
                    <div class="modal fade" id="monmembre">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Membre</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="type" value="membre">
                                        <input type="hidden" name="idmembre" id="idmembre" value="">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label>Nom</label>
                                                <input type="text" class="form-control form-control-sm" name="nom_membre" id="nom_membre" placeholder="Nom">
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Prénom(s)</label>
                                                <input type="text" class="form-control form-control-sm" name="prenom_membre" id="prenom_membre" placeholder="Prénom">
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Specialité</label>
                                                <select class="form-control form-control-sm " name="id_specialite_membre" id="id_specialite">
                                                    <option  disabled>Sélectionnez ici</option>
                                                    <?php 
                                                        foreach ($liste_specialite as $key => $value) {
                                                            echo "<option value=".$value["idspecialite"].">".$value["intitule"]." </option>";
                                                        }
                                                    ?>  

                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-primary btn-sm mt-4" id="btn_gest_membre">Ajouter</button>
                                                <button type="button" class="btn btn-dark btn-sm mt-4" onclick="btn_annuler_membre()">Annuler</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-bordered mt-3">
                                                <thead>
                                                    <th>*</th>
                                                    <th>Nom</th>
                                                    <th>Prénom(s)</th>
                                                    <th>Spécialité</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($liste_membre as $key => $value){
                                                            $idmembre = $value["idmembre"];
                                                            $nom_membre = $value["nom"];
                                                            $prenom_membre = $value["prenom"];
                                                            $id_specialite = $value["idspecialite"];
                                                            echo "<tr>";
                                                            echo "<td>".$idmembre."</td>";
                                                            echo "<td>".$nom_membre."</td>";
                                                            echo "<td>".$prenom_membre."</td>";
                                                            echo "<td>".$value["intitule"]."</td>";
                                                            echo "<td><button class='btn btn-warning btn-sm' onclick='getDetailMembre(\"$nom_membre\",\" $prenom_membre\",$id_specialite,$idmembre)'> <i class='bi bi-pen'></i></button></td>";
                                                            echo "</tr>";
                                                        }
                                                    ?>
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
            <div class="row shadow-sm bg-success p-2 rounded bg-opacity-25">
                <div class="col-sm-1">
                    <label for="">Num</label>
                    <input type='text' class="form-control form-control-sm" name="num_projet" disabled/>
                </div>
                <div class="col-sm-2">
                    <label for="">Projet</label>
                    <input type='text' class="form-control form-control-sm" name="nom_projet" />
                </div>
                <div class="col-sm-2">
                    <label for="">Début</label>
                    <input type='date' class="form-control form-control-sm" name="date_debut_projet" />
                </div>
                <div class="col-sm-2">
                    <label for="">Fin</label>
                    <input type='date' class="form-control form-control-sm" name="date_fin_projet" />
                </div>
                <div class="col-sm-2">
                    <label for="">Membre</label>
                    <select class="form-control form-control-sm" name="membre_projet" id="membre_projet">

                    </select>
                </div>
                <div class="col-sm-2">
                    <label for="">Specialite</label>
                    <input class="form-control form-control-sm" type="text" disabled/>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary btn-sm mt-4"><i class="bi bi-plus-lg"></i></button>
                    <button type="button" class="btn btn-dark btn-sm mt-4"><i class="bi bi-x-lg"></i></button>
                </div>
            </div>
            <div class="row mt-3">
            <div class="col-sm-12">
                    <table class="table table-bordered table-center">
                        <thead>
                            <th>*</th>
                            <th>Num</th>
                            <th>Projet</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th>Détails</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
       
        <script src="script/script.js" ></script>

    </body>
</html>