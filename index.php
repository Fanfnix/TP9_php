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
foreach ($etudiants as $etudiant) echo "<li> $etudiant->nom $etudiant->prenom </li>";
echo "</ul>";

echo "<h2>Liste Classes</h2><ul>";
foreach ($classes as $classe) echo "<li> $classe->libelle </li>";
echo "</ul>";

echo "<h2>Liste Classes</h2><ul>";
foreach ($professeurs as $professeur) echo "<li> $professeur->nom $professeur->prenom | $professeur->libelle - $professeur->lib</li>";
echo "</ul>";

?>