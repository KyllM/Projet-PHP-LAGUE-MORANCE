<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$host = 'lakartxela'; 
$username = 'kmorance_bd'; 
$passwrd = 'kmorance_bd'; 
$database = 'kmorance_bd'; 

$conn = new mysqli($host, $username, $passwrd, $database);

if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

// Suppression d'un CD
if (isset($_GET['supprimer_id'])) {
    $idCD = $_GET['supprimer_id'];
    $sql_delete = "DELETE FROM CD WHERE idCD = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    
    if ($stmt_delete) {
        $stmt_delete->bind_param("i", $idCD);
        if ($stmt_delete->execute()) {
            echo "<div class='alert alert-success'>CD supprimé avec succès.</div>";
        } else {
            echo "<div class='alert alert-danger'>Erreur lors de la suppression du CD: " . $stmt_delete->error . "</div>";
        }
        $stmt_delete->close();
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la préparation de la requête: " . $conn->error . "</div>";
    }
}

$sql = "SELECT * FROM CD";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des CD administrateur</title>
</head>
<body>
<div class="container">
    <nav class="d-flex justify-content-end my-3">
        <a href="logout.php" class="btn btn-secondary">Se déconnecter</a>
    </nav>

    <h1 class="text-center my-4">Gestion des CD</h1>

    <div class="text-end mb-4">
        <a href="formulaire_creation.php" class="btn btn-primary">Ajouter un CD</a>
    </div>

    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?php echo $row['lienImage']; ?>" class="card-img-top" alt="Image du CD">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['titreCD']; ?></h5>
                            <p class="card-text">Artiste: <?php echo $row['auteurCD']; ?></p>
                            <p class="card-text">Prix: <?php echo $row['prixCD']; ?> €</p>
                            <p class="card-text">Genre: <?php echo $row['genreCD']; ?></p>
                            <a href="?supprimer_id=<?php echo $row['idCD']; ?>" class="btn btn-danger">Supprimer</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">Aucun CD trouvé.</p>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
