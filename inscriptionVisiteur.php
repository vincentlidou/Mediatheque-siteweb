<?php
session_start();

include_once ('includes.php');


//si une session est déjà ouverte alors il est impossible de revenir sur la page inscription.php
if(isset($_SESSION['Id_Visiteur'])){
		header('Location: index.php');
		exit;
}


if(isset($_POST['Modification'])){
	
	// variables dans lesquelles seront enregistrées les informations fournies dans le formulaire
    $Nom = $_POST["Nom_Visiteur"];
	$Prenom = $_POST["Prenom_Visiteur"];
	$Date_Naissance = $_POST["Date_Naissance"];
	$AdresseMail = $_POST["Adresse_Mail_Visiteur"];
	$MotDePasse = $_POST["Mot_De_Passe_Visiteur"];
	$Adresse = $_POST["Adresse"];
	$CP= $_POST["Code_Postal"];
	$Ville= $_POST["Ville"];


    if (!empty($_POST)){    //conditions forçant la saisie de toutes les infos dans le formulaire
    extract($_POST);
    $valid = true;

    if(empty($Nom)){
    $valid = false;
    $error_Nom = "Veuillez inscrire un Nom";
    }

    if(empty($Prenom)){
    $valid = false;
    $error_Prenom = "Veuillez inscrire un Prénom";
    }

    if(empty($Date_Naissance)){
    $valid = false;
    $error_Prenom = "Veuillez inscrire une date de naissance";
    }

    if(empty($AdresseMail)){
    $valid = false;
    $error_AdresseMail = "Veuillez inscrire une Adresse Mail";
    }
    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
    {
    echo 'L\'adresse ' . $_POST['mail'] . ' est <strong>invalide</strong> !';
    }

    if(empty($MotDePasse)){
    $valid = false;
    $error_MotDePasse = "Veuillez inscrire un Mot de Passe";
    }

    if(empty($Adresse)){
    $valid = false;
    $error_Adresse = "Veuillez inscrire une Adresse";
    }

    if(empty($CP)){
    $valid = false;
    $error_CP = "Veuillez inscrire un Code Postal";
    }

    if(empty($Ville)){
    $valid = false;
    $error_Ville = "Veuillez inscrire une Ville";
    }

    //requête insérant un visiteur dans la BDD
    $DB->insert('INSERT into visiteur (Nom_Visiteur,
    Prenom_Visiteur,
    Date_Naissance,
    Adresse_Mail_Visiteur,
    Mot_De_Passe_Visiteur,
    Adresse,
    Code_Postal,
    Ville)
    values (:Nom_Visiteur,
    :Prenom_Visiteur,
    :Date_Naissance,
    :Adresse_Mail_Visiteur,
    :Mot_De_Passe_Visiteur,
    :Adresse,
    :Code_Postal,
    :Ville)',
    array('Nom_Visiteur' => $Nom,
    'Prenom_Visiteur' => $Prenom,
    'Date_Naissance' => $Date_Naissance,
    'Adresse_Mail_Visiteur' => $AdresseMail,
    'Mot_De_Passe_Visiteur'=> $MotDePasse,
    'Adresse' => $Adresse,
    'Code_Postal' => $CP,
    'Ville' => $Ville));
    header('Location: index.php');
    exit;

 }
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./style-CSS.css">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <title>Inscrivez-vous</title>
</head>
<body>
    <h1 class="index-h1">Inscription</h1>
    <form class="formulaire" method="post" action="inscriptionVisiteur.php">
        <label>
            <span>Nom</span><br/>
            <?php         // lignes permettant de contrôler si il y a un erreur ou absence de saisie dans le formulaire
                if(isset($error_Nom_Visiteur)){
                    echo '<span class="alerte">'.$error_Nom_Visiteur."</span><br/>";
                }
            ?>
            <input type="text" name="Nom_Visiteur" placeholder="Nom" maxlength="20" required="required">
        </label><br/>
        <label>
            <span>Prenom</span><br/>
            <?php 
                if(isset($error_Prenom_Visiteur)){
                    echo '<span class="alerte">'.$error_Prenom_Visiteur."</span><br/>";
                }
            ?>
            <input type="text" name="Prenom_Visiteur" placeholder="Prenom" maxlength="20" required="required">
        </label><br/>
        <label>
            <span>Date de naissance</span><br/>
            <?php 
                if(isset($error_Date_Naissance)){
                    echo '<span class="alerte">'.$error_Date_Naissance."</span><br/>";
                }
            ?>
            <input type="text" name="Date_Naissance" placeholder="aaaa.mm.jj" maxlength="10" required="required">
        </label><br/>
        <label>
            <span>Adresse e-mail</span><br/>
            <?php 
                if(isset($error_Adresse_Mail_Visiteur)){
                    echo '<span class="alerte">'.$error_Adresse_Mail_Visiteur."</span><br/>";
                }
            ?>
            <input type="text" name="Adresse_Mail_Visiteur" placeholder="Adresse Mail" maxlength="40" required="required">
        </label><br/>
        <label>
            <span>Mot de passe</span><br/>
            <?php 
                if(isset($error_Mot_De_Passe_Visiteur)){
                    echo '<span class="alerte">'.$error_Mot_De_Passe_Visiteur."</span><br/>";
                }
            ?>
            <input type="password" name="Mot_De_Passe_Visiteur" placeholder="Mot de Passe" maxlength="20" required="required">
		</label><br/>
        <label>
            <span>Adresse</span><br/>
            <?php 
                if(isset($error_Adresse)){
                    echo '<span class="alerte">'.$error_Adresse."</span><br/>";
                }
            ?>
            <input type="text" name="Adresse" placeholder="Adresse" maxlength="60" required="required">
        </label><br/>
        <label>
            <span>Code Postal</span><br/>
            <?php 
                if(isset($error_Code_Postal)){
                    echo '<span class="alerte">'.$error_Code_Postal."</span><br/>";
                }
            ?>
            <input type="text" name="Code_Postal" placeholder="Code Postal" maxlength="20" required="required">
        </label><br/>
        <label>
            <span>Ville</span><br/>
            <?php 
                if(isset($error_Ville)){
                    echo '<span class="alerte">'.$error_Ville."</span><br/>";
                }
            ?>
            <input type="text" name="Ville" placeholder="Ville" maxlength="20" required="required">
        </label><br/>

        <br><button class="bouton" name="Modification" type="submit">Inscription</button>


    </form>

</body>
</html>