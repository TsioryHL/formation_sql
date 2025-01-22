
function getDetailUpdate(nom,description,idpartenaire){
    console.log(nom)
    console.log(description)
    console.log(idpartenaire)
    document.getElementById("idpartenaire").value = idpartenaire
    document.getElementById("nom_partenaire").value = nom
    document.getElementById("description_partenaire").value = description
    document.getElementById("btn_gest_partenaire").innerHTML = "Enregistrer"
    document.getElementById("btn_gest_partenaire").className = "btn btn-success btn-sm"
}

function annulation_partenaire(){
    document.getElementById("idpartenaire").value = null
    document.getElementById("nom_partenaire").value = null
    document.getElementById("description_partenaire").value = null
    document.getElementById("btn_gest_partenaire").innerHTML = "Ajouter"
    document.getElementById("btn_gest_partenaire").className = "btn btn-primary btn-sm"

}


function getDetailUpdateSpecialite(intitule,idspecialite){
    console.log(intitule)
    console.log(idspecialite)
    document.getElementById("intitule_specialite").value = intitule
    document.getElementById("id_specialite").value = idspecialite
    document.getElementById("btn_gest_specialite").innerHTML = "Enregistrer"
    document.getElementById("btn_gest_specialite").className = "btn btn-success btn-sm"
}

function btn_annuler_specialite(){
    document.getElementById("intitule_specialite").value = null
    document.getElementById("id_specialite").value = null
    document.getElementById("btn_gest_specialite").innerHTML = "Ajouter"
    document.getElementById("btn_gest_specialite").className = "btn btn-primary btn-sm"
}


function getDetailMembre(nom,prenom,idspecialite,idmembre){
    console.log("eto",idspecialite);
    console.log("eto",nom);
    console.log("eto",prenom);
    
    document.getElementById("idmembre").value = idmembre
    document.getElementById("nom_membre").value = nom
    document.getElementById("prenom_membre").value = prenom
    document.getElementById("id_specialite").value = idspecialite
    document.getElementById("btn_gest_membre").innerHTML = "Enregistrer"
    document.getElementById("btn_gest_membre").className = "btn btn-success btn-sm mt-4"
}

function btn_annuler_membre(){
    document.getElementById("idmembre").value = null
    document.getElementById("nom_membre").value = null
    document.getElementById("prenom_membre").value = null
    document.getElementById("id_specialite").value = ""

    document.getElementById("btn_gest_membre").innerHTML = "Ajouter"
    document.getElementById("btn_gest_membre").className = "btn btn-primary btn-sm mt-4"
}