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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titreCD = $_POST['titreCD'];
    $auteurCD = $_POST['auteurCD'];
    $prixCD = $_POST['prixCD'];
    $genreCD = $_POST['genreCD'];
    $lienImage = $_POST['lienImage'];

    $sql = "INSERT INTO CD (titreCD, auteurCD, prixCD, genreCD, lienImage) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssdss", $titreCD, $auteurCD, $prixCD, $genreCD, $lienImage);

        if ($stmt->execute()) {
            header("Location: page_accueil.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de l'ajout du CD: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la préparation de la requête: " . $conn->error . "</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Administration - Gestion des CD</title>
</head>
<body>
<div class="container">
    <h1 class="text-center my-4">Gestion des CD</h1>

    <h2>Ajouter un CD</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="titreCD" class="form-label">Titre</label>
            <input type="text" class="form-control" id="titreCD" name="titreCD" required>
        </div>
        <div class="mb-3">
            <label for="auteurCD" class="form-label">Artiste</label>
            <input type="text" class="form-control" id="auteurCD" name="auteurCD" required>
        </div>
        <div class="mb-3">
            <label for="prixCD" class="form-label">Prix (€)</label>
            <input type="number" class="form-control" id="prixCD" name="prixCD" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="genreCD" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genreCD" name="genreCD" required>
        </div>
        <div class="mb-3">
            <label for="lienImage" class="form-label">Lien de l'image</label>
            <input type="text" class="form-control" id="lienImage" name="lienImage" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter CD</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
