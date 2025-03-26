<?php require_once("model/pdo.php") ?>

<?php

$resultat = $dbPDO->prepare("SELECT * FROM etudiants");
$resultat->execute() or die(print_r($resultat->errorInfo()));
$etudiants = $resultat->fetchAll(PDO::FETCH_CLASS);

$resultat = $dbPDO->prepare("SELECT * FROM classes");
$resultat->execute() or die(print_r($resultat->errorInfo()));
$classes = $resultat->fetchAll(PDO::FETCH_CLASS);

$resultat = $dbPDO->prepare("SELECT * FROM professeurs
    INNER JOIN classes ON professeurs.id_classe = classes.id
    INNER JOIN matiere ON professeurs.id_matiere = matiere.id
    ");
$resultat->execute() or die(print_r($resultat->errorInfo()));
$professeurs = $resultat->fetchAll(PDO::FETCH_CLASS);

echo "<h2>Liste Etudiants</h2><ul>";
foreach ($etudiants as $etudiant) {
    $adresse_modif = "views/modif_etudiant.php?id=".$etudiant->id;
    $adresse_suppr = "views/suppression_etudiant.php?id=".$etudiant->id;
    echo "<li> $etudiant->nom $etudiant->prenom <a href=$adresse_modif>Modifier</a> <a href=$adresse_suppr>Supprimer</a></li>";
}
echo "</ul>";

echo "<h2>Liste Classes</h2><ul>";
foreach ($classes as $classe) echo "<li> $classe->libelle </li>";
echo "</ul>";

echo "<h2>Liste Classes</h2><ul>";
foreach ($professeurs as $professeur) echo "<li> $professeur->nom $professeur->prenom | $professeur->libelle - $professeur->lib</li>";
echo "</ul>";

$ajout = $dbPDO->prepare("INSERT INTO matiere (lib) VALUES ('Maths')");
$ajout->execute() or die(print_r($ajout->errorInfo()));
$result = $ajout->fetchAll(PDO::FETCH_CLASS);

?>

<form action="views/nouvelle_matiere.php" method="post">
    <label for="matiere">Entrez une matière à ajouter</label>
    <input type="text" name="matiere"/>
    <input type="submit" value="Valider"/>
</form>

<form action="views/nouvel_etudiant.php" method="post">
    <label for="prenom">Entrez prenom de l'étudiant</label>
    <input type="text" name="prenom"/>

    <label for="nom">Entrez nom de l'étudiant</label>
    <input type="text" name="nom"/>

    <label>Choix classe</label>
    <select name="classe_id">
        <?php
            $resultat = $dbPDO->prepare("SELECT * FROM classes");
            $resultat->execute() or die(print_r($resultat->errorInfo()));
            $classes = $resultat->fetchAll(PDO::FETCH_CLASS);
            foreach ($classes as $classe) {
                $choix = $classe->id;
                $text = $classe->libelle;
                echo "<option value=$choix>$text</option>";
            }
        ?>
    </select>
    <input type="submit" value="Valider"/>
</form>