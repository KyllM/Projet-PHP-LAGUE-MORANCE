<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

$host = 'lakartxela';
$username = 'kmorance_bd';
$passwrd = 'kmorance_bd';
$database = 'kmorance_bd';

$conn = new mysqli($host, $username, $passwrd, $database);

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $idCD = $_GET['id'];

    $sql = "DELETE FROM CD WHERE idCD = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $idCD);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>CD supprimé avec succès !</div>";
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de la suppression du CD: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la préparation de la requête: " . $conn->error . "</div>";
    }
}

$sql = "SELECT idCD, titreCD, auteurCD, prixCD, genreCD FROM CD";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Administration - Supprimer un CD</title>
</head>
<body>
<div class="container">
    <
