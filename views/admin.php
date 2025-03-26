<?php require_once("../model/pdo.php") ?>

<head> <link rel="stylesheet" href="../style.css"> </head>

<a href="../index.php">Retour Index</a>

<?php

$identifiant = $_POST['identifiant'];
$password = $_POST['password'];

$resultat = $dbPDO->prepare("SELECT * FROM user");
$resultat->execute() or die(print_r($resultat->errorInfo()));
$users = $resultat->fetchAll(PDO::FETCH_CLASS);

$authorize = 0;

foreach ($users as $user) {
    if ($identifiant == $user->pseudo && $password == $user->password) $authorize = 1;
}

if ($authorize == 1) {

    echo "<h1>Bonjour $identifiant</h1>";

    $resultat = $dbPDO->prepare("SELECT * FROM etudiants");
    $resultat->execute() or die(print_r($resultat->errorInfo()));
    $etudiants = $resultat->fetchAll(PDO::FETCH_CLASS);

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
        $adresse_modif = "./modif_etudiant.php?id=".$etudiant->id;
        $adresse_suppr = "./suppression_etudiant.php?id=".$etudiant->id;
        echo "<tr>
            <th scope='col'>$etudiant->prenom</th>
            <th scope='col'>$etudiant->nom</th>
            <th scope='col'><a href=$adresse_modif>Modifier</a></th>
            <th scope='col'><a href=$adresse_suppr>Supprimer</a></th>
        </tr>";
    }
    echo "</tbody></table>";

    echo "
    <form action='./nouvelle_matiere.php' method='post'>
        <label for='matiere'>Entrez une matière à ajouter</label>
        <input type='text' name='matiere'/>
        <input type='submit' value='Valider'/>
    </form>

    <form action='./nouvel_etudiant.php' method='post'>
        <label for='prenom'>Entrez prenom de l'étudiant</label>
        <input type='text' name='prenom'/>

        <label for='nom'>Entrez nom de l'étudiant</label>
        <input type='text' name='nom'/>

        <label>Choix classe</label>
        <select name='classe_id'>";
            $resultat = $dbPDO->prepare('SELECT * FROM classes');
            $resultat->execute() or die(print_r($resultat->errorInfo()));
            $classes = $resultat->fetchAll(PDO::FETCH_CLASS);
            foreach ($classes as $classe) {
                $choix = $classe->id;
                $text = $classe->libelle;
                echo "<option value=$choix>$text</option>";
            }
    echo "
        </select>
        <input type='submit' value='Valider'/>
    </form>";
}
else echo "Mot de passe ou identifiant incorrect"

?>