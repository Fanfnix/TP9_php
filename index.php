<?php require_once("model/pdo.php") ?>

<head> <link rel="stylesheet" href="style.css"> </head>

<form action="views/admin.php" method="post" id="connection">
    <div class="champ">
        <label for="identifiant">Entrez identifiant</label>
        <input type="text" name="identifiant" required/>
    </div>

    <div class="champ">
    <label for="password">Entrez mot-de-passe</label>
    <input type="text" name="password" required/>
    </div>

    <button type="submit">Submit</button>
</form>

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
    </tr>";
echo "</thead><tbody>";
foreach ($etudiants as $etudiant) {
    echo "<tr>
        <th scope='col'>$etudiant->prenom</th>
        <th scope='col'>$etudiant->nom</th>
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