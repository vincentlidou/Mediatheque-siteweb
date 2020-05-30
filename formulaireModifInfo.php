<?php

session_start();

include_once ('includes.php');


//Si connecté , plus possible de retourner sur la page d'inscription / de login
if(isset($_SESSION['Id_Visiteur'])){

}

if (!empty($_POST)){
    extract($_POST);
    $session = $_SESSION['Id_Visiteur'];
    $valid = true;


    if (isset($_POST['Nom_Visiteur'])) { 
    $Nom_Visiteur = htmlspecialchars(trim($_POST["Nom_Visiteur"]));
    }
    if (isset($_POST['Prenom_Visiteur'])) { 
    $Prenom_Visiteur = htmlspecialchars(trim($_POST["Prenom_Visiteur"]));
    }
    if (isset($_POST['Date_Naissance'])) { 
    $Date_Naissance = htmlspecialchars(trim($_POST["Date_Naissance"]));
    }
    if (isset($_POST['Adresse_Mail_Visiteur'])) { 
    $Adresse_Mail_Visiteur = htmlspecialchars(trim($_POST["Adresse_Mail_Visiteur"]));
    }
    if (isset($_POST['Mot_De_Passe_Visiteur'])) { 
    $Mot_De_Passe_Visiteur = htmlspecialchars(trim($_POST["Mot_De_Passe_Visiteur"]));
    }
    if (isset($_POST['Adresse'])) { 
    $Adresse = htmlspecialchars(trim($_POST["Adresse"]));
    }
    if (isset($_POST['Code_Postal'])) { 
    $Code_Postal = htmlspecialchars(trim($_POST["Code_Postal"]));
    }
    if (isset($_POST['Ville'])) { 
    $Ville = htmlspecialchars(trim($_POST["Ville"]));
    }

    
    if(empty($Nom_Visiteur)){ 
        $valid = false;
        $error_Nom_Visiteur = "Veuillez renseigner un nom";
    }
    if(empty($Prenom_Visiteur)){ 
        $valid = false;
        $error_Prenom_Visiteur = "Veuillez renseigner un prenom";
    }
    if(empty($Date_Naissance)){ 
        $valid = false;
        $error_Date_Naissance = "Veuillez renseigner une date de naissance";
    }
    if(empty($Adresse_Mail_Visiteur)){ 
        $valid = false;
        $error_Adresse_Mail_Visiteur = "Veuillez inscrire une Adresse Mail";
    }
    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['Adresse_Mail_Visiteur']))
    {
    echo 'L\'adresse ' . $_POST['Adresse_Mail_Visiteur'] . ' est <strong>invalide</strong> !';
    }
    if(empty($Mot_De_Passe_Visiteur)){ 
        $valid = false;
        $error_Mot_De_Passe_Visiteur = "Veuillez renseigner un mot de passe";
    }
    if(empty($Adresse)){ 
        $valid = false;
        $error_Adresse = "Veuillez renseigner votre adresse";
    }
    if(empty($Code_Postal)){ 
        $valid = false;
        $error_Code_Postal = "Veuillez renseigner votre code postal";
    }
    if(empty($Ville)){ 
        $valid = false;
        $error_Ville = "Veuillez renseigner votre ville";
    }

    if($valid){
        $req = $DB->insert("UPDATE visiteur SET Nom_Visiteur= '$Nom_Visiteur', Prenom_Visiteur='$Prenom_Visiteur',  Date_Naissance='$Date_Naissance', Adresse_Mail_Visiteur='$Adresse_Mail_Visiteur', Mot_De_Passe_Visiteur='$Mot_De_Passe_Visiteur', Adresse='$Adresse', Code_Postal='$Code_Postal', Ville='$Ville' WHERE Id_Visiteur='$session'",
        array('Nom_Visiteur' => $Nom_Visiteur,
        'Prenom_Visiteur' => $Prenom_Visiteur,
        'Date_Naissance' => $Date_Naissance,
        'Adresse_Mail_Visiteur' => $Adresse_Mail_Visiteur,
        'Mot_De_Passe_Visiteur'=> $Mot_De_Passe_Visiteur,
        'Adresse' => $Adresse,
        'Code_Postal' => $Code_Postal,
        'Ville' => $Ville));
        $_SESSION['Nom_Visiteur'] = $Nom_Visiteur;
		$_SESSION['Prenom_Visiteur'] = $Prenom_Visiteur;
		$_SESSION['Date_Naissance'] = $Date_Naissance;
		$_SESSION['Adresse_Mail_Visiteur'] = $Adresse_Mail_Visiteur;
		$_SESSION['Mot_De_Passe_Visiteur'] = $Mot_De_Passe_Visiteur;
		$_SESSION['Adresse'] = $Adresse;
		$_SESSION['Code_Postal'] = $Code_Postal;
        $_SESSION['Ville'] = $Ville;
        header('Location: recherche.php');
        exit;

    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./style-CSS.css">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <title>Modification des informations personnelles</title>
</head>
<body>
    <h1 class="index-h1">Modification des informations personnelles</h1>
    <form class="formulaire" method="post" action="FormulaireModifInfo">
        <label>
            <span>Nom</span><br/>
            <input type="text" name="Nom_Visiteur" <?php echo 'value="'. $_SESSION['Nom_Visiteur'] .'"'; ?> maxlength="20" required="required">
        </label><br/>
        <label>
            <span>Prenom</span><br/>
            <input type="text" name="Prenom_Visiteur" <?php echo 'value="'. $_SESSION['Prenom_Visiteur'] .'"'; ?> maxlength="20" required="required">
        </label><br/>
        <label>
            <span>Date de naissance</span><br/>
            <input type="text" name="Date_Naissance" <?php echo 'value="'. $_SESSION['Date_Naissance'] .'"'; ?> maxlength="10" required="required">
        </label><br/>
        <label>
            <span>Adresse e-mail</span><br/>
            <input type="text" name="Adresse_Mail_Visiteur" <?php echo 'value="'. $_SESSION['Adresse_Mail_Visiteur'] .'"'; ?> maxlength="40" required="required">
        </label><br/>
        <label>
            <span>Mot de passe</span><br/>
            <input type="password" name="Mot_De_Passe_Visiteur" <?php echo 'value="'. $_SESSION['Mot_De_Passe_Visiteur'] .'"'; ?> maxlength="20" required="required">
        </label><br/>
        <label>
            <span>Adresse</span><br/>
            <input type="text" name="Adresse" <?php echo 'value="'. $_SESSION['Adresse'] .'"'; ?> maxlength="60" required="required">
        </label><br/>
        <label>
            <span>Code Postal</span><br/>
            <input type="text" name="Code_Postal" <?php echo 'value="'. $_SESSION['Code_Postal'] .'"'; ?> maxlength="5" required="required">
        </label><br/>
        <label>
            <span>Ville</span><br/>
            <input type="text" name="Ville" <?php echo 'value="'. $_SESSION['Ville'] .'"'; ?> maxlength="20" required="required">
        </label><br/>

        <br><button class="bouton" name="Modification" type="submit">Modifier</button>


    </form>

    <button id="retourbouton" class="bouton_Back" name="retourArriere" onclick="document.location.href='recherche.php'"><img src=image/back.png height="25" weight="25"></button>
    <button id="deconnexion_bouton" class="bouton_Deco" name="deconnexion" onclick="document.location.href='deconnexion.php'"><img src=image/deco.png height="25" weight="25"></button>
    <button id="modifInfos_bouton" class="bouton_Modif" name="modifierInfosPerso" onclick="document.location.href='formulaireModifInfo.php'"><img src=image/gear.png height="25" weight="25"></button>

</body>
</html>