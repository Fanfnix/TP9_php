<?php require_once("../model/pdo.php") ?>

<a href="../index.php">Retour Index</a>

<?php

    $suppr = $dbPDO->prepare("DELETE FROM etudiants WHERE id=:id");
    $suppr->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $suppr->execute() or die(print_r($suppr->errorInfo()));
    $result = $suppr->fetchAll(PDO::FETCH_CLASS);

    echo "Vous avez supprimé ".$_POST['prenom']." ".$_POST['nom']." en classe d'id ".$_POST['classe_id'];
?>