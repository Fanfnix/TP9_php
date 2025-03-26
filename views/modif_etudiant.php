<?php require_once("../model/pdo.php") ?>

<a href="../index.php">Retour Index</a>

<?php
    $modif = $dbPDO->prepare("SELECT * FROM etudiants WHERE id=:id");
    $modif->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $modif->execute() or die(print_r($modif->errorInfo()));
    $etudiant = $modif->fetchAll(PDO::FETCH_CLASS);
?>

<form action="./modif_etudiants.php?id=<?=$_GET['id']?>" method="post">
    <label for="prenom">Entrez prenom de l'étudiant</label>
    <input type="text" name="prenom" value="<?=$etudiant['prenom']?>" required/>

    <label for="nom">Entrez nom de l'étudiant</label>
    <input type="text" name="nom" value="<?=$etudiant['nom']?>" required/>

    <input type="submit" value="Modifier"/>
</form>

<?php
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];

    $modif = $dbPDO->prepare("UPDATE etudiants SET prenom=:prenom, nom=:nom WHERE id=:id");
    $modif->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $modif->bindParam(':nom', $nom, PDO::PARAM_STR);
    $modif->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $modif->execute() or die(print_r($modif->errorInfo()));
    $result = $modif->fetchAll(PDO::FETCH_CLASS);

    echo "Vous avez modifier ".$etudiant['prenom']." ".$etudiant['nom']." en classe d'id ".$etudiant['classe_id'];
?>