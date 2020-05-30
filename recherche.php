<?php
session_start();
include_once('includes.php');

if (isset($_GET["Recherche_Titre"]) and !empty($_GET["Recherche_Titre"])) {
    $rechercheTitre = htmlspecialchars(trim($_GET["Recherche_Titre"]));
}

if (isset($_GET["Recherche_Auteur"]) and !empty($_GET["Recherche_Auteur"])) {
    $rechercheNomAuteur = htmlspecialchars(trim($_GET["Recherche_Auteur"]));
}
if (isset($_GET["Recherche_Isbn"]) and !empty($_GET["Recherche_Isbn"])) {
    $rechercheISBN = htmlspecialchars(trim($_GET["Recherche_Isbn"]));
}
if (isset($_GET["Recherche_Annee"]) and !empty($_GET["Recherche_Annee"])) {
    $rechercheAnnee = htmlspecialchars(trim($_GET["Recherche_Annee"]));
}

if (isset($rechercheTitre) and !empty($rechercheTitre)) {
    $req = $DB->query(
        'SELECT Prenom_Auteur,Nom_Auteur,Titre,Annee_publication,Nom_Categorie,livre.Id_Livre,Synopsis,ISBN FROM livre
    INNER JOIN ecrit_par ON livre.Id_Livre = ecrit_par.Id_Livre
    INNER JOIN auteur ON auteur.Id_Auteur = ecrit_par.Id_Auteur
    INNER JOIN trie_par ON trie_par.Id_Livre = livre.Id_Livre
    INNER JOIN categories ON categories.Id_Categorie = trie_par.Id_Categorie
    WHERE Titre = :Titre',
        array('Titre' => $rechercheTitre)
    );
} elseif (isset($rechercheNomAuteur) and !empty($rechercheNomAuteur)) {
    $req = $DB->query(
        'SELECT Prenom_Auteur,Nom_Auteur,Titre,Annee_publication,Nom_Categorie,livre.Id_Livre,Synopsis,ISBN FROM livre
        INNER JOIN ecrit_par ON livre.Id_Livre = ecrit_par.Id_Livre
        INNER JOIN auteur ON auteur.Id_Auteur = ecrit_par.Id_Auteur
        INNER JOIN trie_par ON trie_par.Id_Livre = livre.Id_Livre
        INNER JOIN categories ON categories.Id_Categorie = trie_par.Id_Categorie
        WHERE Nom_Auteur = :Nom_Auteur',
        array('Nom_Auteur' => $rechercheNomAuteur)
    );
} elseif (isset($rechercheISBN) and !empty($rechercheISBN)) {
    $req = $DB->query(
        'SELECT Prenom_Auteur,Nom_Auteur,Titre,Annee_publication,Nom_Categorie,livre.Id_Livre,ISBN,Synopsis,ISBN FROM livre
        INNER JOIN ecrit_par ON livre.Id_Livre = ecrit_par.Id_Livre
        INNER JOIN auteur ON auteur.Id_Auteur = ecrit_par.Id_Auteur
        INNER JOIN trie_par ON trie_par.Id_Livre = livre.Id_Livre
        INNER JOIN categories ON categories.Id_Categorie = trie_par.Id_Categorie
        WHERE ISBN = :ISBN',
        array('ISBN' => $rechercheISBN)
    );
} elseif (isset($rechercheAnnee) and !empty($rechercheAnnee)) {
    $req = $DB->query(
        'SELECT Prenom_Auteur,Nom_Auteur,Titre,Annee_publication,Nom_Categorie,livre.Id_Livre,Synopsis,ISBN FROM livre
        INNER JOIN ecrit_par ON livre.Id_Livre = ecrit_par.Id_Livre
        INNER JOIN auteur ON auteur.Id_Auteur = ecrit_par.Id_Auteur
        INNER JOIN trie_par ON trie_par.Id_Livre = livre.Id_Livre
        INNER JOIN categories ON categories.Id_Categorie = trie_par.Id_Categorie
        WHERE Annee_publication = :anneePublication',
        array('anneePublication' => $rechercheAnnee)
    );
} else {
    $req = $DB->query(
        'SELECT Prenom_Auteur,Nom_Auteur,Titre,Annee_publication,Nom_Categorie,livre.Id_Livre,ISBN FROM livre
        INNER JOIN ecrit_par ON livre.Id_Livre = ecrit_par.Id_Livre
        INNER JOIN auteur ON auteur.Id_Auteur = ecrit_par.Id_Auteur
        INNER JOIN trie_par ON trie_par.Id_Livre = livre.Id_Livre
        INNER JOIN categories ON categories.Id_Categorie = trie_par.Id_Categorie'
    );
}


?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="./style-CSS.css">
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sketchy/bootstrap.min.css">
    <title>Rechercher</title>
</head>

<body>
    <div class="formTab">
        <h1 class="index-h1">Recherche</h1>
        <form class='form' method="GET" action="recherche.php">
            <input class="boutonRecherche" type="text" name="Recherche_Titre" placeholder="Rechercher par titre">
            <input class="boutonRecherche" type="text" name="Recherche_Auteur" placeholder="Rechercher par auteur">
            <input class="boutonRecherche" type="text" name="Recherche_Isbn" placeholder="Rechercher par ISBN">
            <input class="boutonRecherche" type="text" name="Recherche_Annee" placeholder="Rechercher par année de publication">
            <button class="bouton">Rechercher</button>
        </form>
        <table class='tab'>
            <tr>
                <th class="tailleEcritureTitreTableau">Prenom</th>
                <th class="tailleEcritureTitreTableau">Nom</th>
                <th class="tailleEcritureTitreTableau">Titre</th>
                <th class="tailleEcritureTitreTableau">Année</th>
                <th class="tailleEcritureTitreTableau">ISBN</th>
                <th class="tailleEcritureTitreTableau">Catégorie</th>
            </tr>
            <?php foreach ($req as $r) { ?>
                <tr>
                    <td class="tailleEcriture"> <?= $r["Prenom_Auteur"] ?> </td>
                    <td class="tailleEcriture"> <?= $r["Nom_Auteur"] ?> </td>
                    <td class="tailleEcriture"><?= $r["Titre"] ?></td>
                    <td class="tailleEcriture"><?= $r["Annee_publication"] ?></td>
                    <td class="tailleEcriture"> <?= $r["ISBN"] ?> </td>
                    <td class="tailleEcriture"> <?= $r["Nom_Categorie"] ?> </td>
                    <td  class="tailleEcriture"><a id="ficheLivre" href="ficheLivre.php?id=<?= $r['Id_Livre'] ?>">Fiche Livre</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>





    <br />
    <button id="deconnexion_bouton" class="bouton_Deco" name="deconnexion" onclick="document.location.href='deconnexion.php'"><img src=image/deco.png height="25" weight="25"></button>
    <button id="modifInfos_bouton" class="bouton_Modif" name="modifierInfosPerso" onclick="document.location.href='formulaireModifInfo.php'"><img src=image/gear.png height="25" weight="25"></button>
</body>

</html>