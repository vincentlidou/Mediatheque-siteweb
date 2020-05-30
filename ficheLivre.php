<?php 
session_start();
include_once('includes.php');

$id = htmlspecialchars(trim($_GET["id"]));

$req = $DB->query(
    'SELECT Prenom_Auteur,Nom_Auteur,Titre,Annee_publication,Nombre_Pages,ISBN,Nom_Categorie,livre.Id_Livre,Synopsis,Nom_Langue,Nom_Editeur FROM livre
    INNER JOIN ecrit_par ON livre.Id_Livre = ecrit_par.Id_Livre
    INNER JOIN auteur ON auteur.Id_Auteur = ecrit_par.Id_Auteur
    INNER JOIN trie_par ON trie_par.Id_Livre = livre.Id_Livre
    INNER JOIN categories ON categories.Id_Categorie = trie_par.Id_Categorie
    INNER JOIN langue ON livre.Id_Langue = langue.Id_Langue
    INNER JOIN editeur ON livre.Id_Editeur = editeur.Id_Editeur
    WHERE livre.Id_Livre = :idLivre',array('idLivre' => $id));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="./style-CSS.css">
<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php foreach ($req as $r) { ?>
    <h1 class="index-h1"><?= $r['Titre'] ?></h1>

    <p class="baliseP"><strong>Titre :</strong> <?= $r['Titre'] ?></p>
    <p class="baliseP"><strong>Nombres de pages :</strong> <?= $r['Nombre_Pages'] ?></p>
    <p class="baliseP"><strong>Ecrit par :</strong>  <?php echo $r['Prenom_Auteur'] . ' ' .$r['Nom_Auteur']?></p>  
    <p class="baliseP"><strong>ISBN :</strong> <?= $r['ISBN'] ?></p>
    <p class="baliseP"><strong>Année de publication :  </strong> <?= $r['Annee_publication'] ?></p>  
    <p class="baliseP"><strong>Langue :</strong> <?= $r['Nom_Langue'] ?></p>
    <p class="baliseP"><strong>Catégorie :</strong> <?= $r['Nom_Categorie'] ?></p>  
    <p class="baliseP"><strong>Editeur :</strong> <?= $r['Nom_Editeur'] ?></p>
    <br>
    <p class="balisePSynopsis"><strong>Synopsis:</strong><br><br><?= $r['Synopsis'] ?></p>

    <?php } ?>
     
     <button id="retourbouton" class="bouton_Back" name="retourArriere" onclick="document.location.href='recherche.php'"><img src=image/back.png height="25" weight="25"></button>
     <button id="deconnexion_bouton" class="bouton_Deco" name="deconnexion" onclick="document.location.href='deconnexion.php'"><img src=image/deco.png height="25" weight="25"></button>
     <button id="modifInfos_bouton" class="bouton_Modif" name="modifierInfosPerso" onclick="document.location.href='formulaireModifInfo.php'"><img src=image/gear.png height="25" weight="25"></button>
</body>
</html>