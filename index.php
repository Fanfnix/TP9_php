<?php require_once("model/pdo.php") ?>

<head>
    <link rel="stylesheet" href="style.css">
</head>

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

// Affichage Etudiants

echo "<h2>Liste Etudiants</h2>";
echo "<table><thead>";
echo "<tr>
        <th scope='col'>Prenom</th>
        <th scope='col'>Nom</th>
        <th scope='col'>Modifier</th>
        <th scope='col'>Supprimer</th>
    </tr>";
echo "</thead><tbody>";
foreach ($etudiants as $etudiant) {
    $adresse_modif = "views/modif_etudiant.php?id=".$etudiant->id;
    $adresse_suppr = "views/suppression_etudiant.php?id=".$etudiant->id;
    echo "<tr>
        <th scope='col'>$etudiant->nom</th>
        <th scope='col'>$etudiant->prenom</th>
        <th scope='col'><a href=$adresse_modif>Modifier</a></th>
        <th scope='col'><a href=$adresse_suppr>Supprimer</a></th>
    </tr>";
}
echo "</tbody></table>";

// Affichage Classes

echo "<h2>Liste Classess</h2>";
echo "<table><thead>";
echo "<tr>
        <th scope='col'>Id</th>
        <th scope='col'>Libelle</th>
    </tr>";
echo "</thead><tbody>";
foreach ($classes as $classe) {
    echo "<tr>
        <th scope='col'>$classe->id</th>
        <th scope='col'>$classe->libelle</th>
    </tr>";
}
echo "</tbody></table>";

// Affichage Professeurs

echo "<h2>Liste Professeurs</h2>";
echo "<table><thead>";
echo "<tr>
        <th scope='col'>Prenom</th>
        <th scope='col'>Nom</th>
        <th scope='col'>Classe</th>
        <th scope='col'>Matiere</th>
    </tr>";
echo "</thead><tbody>";
foreach ($professeurs as $professeur) {
    echo "<tr>
        <th scope='col'>$professeur->prenom</th>
        <th scope='col'>$professeur->nom</th>
        <th scope='col'>$professeur->libelle</th>
        <th scope='col'>$professeur->lib</th>
    </tr>";
}
echo "</tbody></table>";

?>

<!-- Formulaire -->

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