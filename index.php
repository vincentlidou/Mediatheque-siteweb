<?php 
session_start();



include_once('includes.php');


if(isset($_SESSION['Adresse_Mail_Visiteur'])){
header('Location: recherche.php'); // envoi directement à la page suivante si la session existe déjà
		exit;
}


if(!empty($_POST)){
	extract($_POST);
	$valid = true;

	$Identifiant_Visiteur = htmlspecialchars(trim($Identifiant_Visiteur)); //Pas de caractères spéciaux (htmlspecialchars) ni espace avant et après (trim)
	$mdp = htmlspecialchars(trim($mdp));

	if(empty($Identifiant_Visiteur)){
		$valid = false;
		$error_mail = "Veuillez entrer un Identifiant e-mail"; //Identifiant mail visiteur non saisi
	}

	if(empty($mdp)){
		$valid = false;
		$error_mdp = "Veuillez entrer un mot de passe"; // Mot de passe correspondant non saisi
	}

	//charge les informations correspondant au mail et mdp entré
	$req = $DB->query('SELECT * FROM visiteur WHERE Adresse_Mail_Visiteur= :Adresse_Mail_Visiteur AND Mot_De_Passe_Visiteur= :Mot_De_Passe_Visiteur',array('Adresse_Mail_Visiteur' => $Identifiant_Visiteur, 'Mot_De_Passe_Visiteur'=> $mdp));
	$req = $req->fetch();

	if(!$req['Adresse_Mail_Visiteur']){
		$valid =false;
		$error_compt = "Votre mail ou mot de passe ne correspondent pas";

	}

	if($valid){

		$_SESSION['Id_Visiteur'] = $req['Id_Visiteur'];
        $_SESSION['Nom_Visiteur'] = $req['Nom_Visiteur'];
        $_SESSION['Prenom_Visiteur'] = $req['Prenom_Visiteur'];
        $_SESSION['Date_Naissance'] = $req['Date_Naissance'];
        $_SESSION['Adresse_Mail_Visiteur'] = $req['Adresse_Mail_Visiteur'];
        $_SESSION['Mot_De_Passe_Visiteur'] = $req['Mot_De_Passe_Visiteur'];
        $_SESSION['Adresse'] = $req['Adresse'];
        $_SESSION['Code_Postal'] = $req['Code_Postal'];
        $_SESSION['Ville'] = $req['Ville'];

		header('Location:recherche.php');
		exit;

	}

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Médiathèque de They-sous-Vaudemont</title>
	<link rel="stylesheet" type="text/css" href="./style-CSS.css">
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
</head>
<body>
<h1 class="index-h1">Bienvenue sur la <br> médiathèque de They-sous-Vaudemont.</h1>
<br>
	 <form class="formulaire" method="post" action="index.php">
			<label>
			<span>Login</span><br/>
			<?php 
				if(isset($error_mail)){
					echo $error_mail."<br/>";
				}
			?>
			<input type="text" name="Identifiant_Visiteur" placeholder="Adresse e-mail" value="<?php if(isset($Identifiant_Visiteur)) echo $Identifiant_Visiteur ?>" maxlength="40" required="required">
			</label><br/>
			<label>
				<span>Mot de passe</span><br/>
				<?php 
					if(isset($error_mdp)){
						echo $error_mdp."<br/>";
					}
				?>
				<input type="password" name="mdp" placeholder="Mot de passe" value="<?php if(isset($mdp)) echo $mdp ?>" maxlength="20" required="required">
			</label><br/>
			<button id="connexion_bouton" name="Connexion">Connexion</button>
			<button id="inscription_bouton" name="Inscription" onclick="document.location.href='inscriptionVisiteur.php'">Inscription</button>
	</form>

</body>
</html>