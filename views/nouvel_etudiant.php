<?php require_once("../model/pdo.php") ?>

<a href="../index.php">Retour Index</a>

<?php
    $ajout = $dbPDO->prepare("INSERT INTO etudiants (prenom, nom, classe_id) VALUES (:prenom, :nom, :classe_id)");
    $ajout->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
    $ajout->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
    $ajout->bindParam(':classe_id', $_POST['classe_id'], PDO::PARAM_INT);
    $ajout->execute() or die(print_r($ajout->errorInfo()));
    $result = $ajout->fetchAll(PDO::FETCH_CLASS);

    echo "Vous avez ajouté ".$_POST['prenom']." ".$_POST['nom']." en classe d'id ".$_POST['classe_id'];
?>