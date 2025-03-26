<?php require_once("../model/pdo.php") ?>

<a href="../index.php">Retour Index</a>

<?php
    $ajout = $dbPDO->prepare("INSERT INTO matiere (lib) VALUES (:matiere)");
    $ajout->bindParam(':matiere', $_POST['matiere'], PDO::PARAM_STR);
    $ajout->execute() or die(print_r($ajout->errorInfo()));
    $result = $ajout->fetchAll(PDO::FETCH_CLASS);

    echo "Vous avez ajouté ".$matiere;
?>