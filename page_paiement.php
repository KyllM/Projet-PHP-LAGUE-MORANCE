<?php 
include 'verif.php'; 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Page de Paiement - Vente de CD</title>
</head>
<body>
<div class="container">
    <h1 class="text-center my-4">Page de Paiement</h1>
    
    <nav class="mb-4 d-flex justify-content-between">
        <div>
            <a href="panier.php" class="btn btn-primary">Revenir au panier</a>
        </div>
        
        <div>
            <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
        </div>
    </nav>

    <form action="traitement_paiement.php" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="numCarte" class="form-label">Numéro de carte (16 chiffres)</label>
            <input type="tel" class="form-control" id="numCarte" name="numCarte" required pattern="\d{16}" title="Veuillez entrer 16 chiffres." maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>
        <div class="mb-3 d-flex">
            <div class="me-2">
                <label for="moisExpiration" class="form-label">Mois (MM)</label>
                <input type="text" class="form-control" id="moisExpiration" name="moisExpiration" required pattern="^(0[1-9]|1[0-2])$" title="Veuillez entrer le mois au format MM." maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
            <div>
                <label for="anneeExpiration" class="form-label">Année (AA)</label>
                <input type="text" class="form-control" id="anneeExpiration" name="anneeExpiration" required pattern="^[0-9]{2}$" title="Veuillez entrer les deux derniers chiffres de l'année." maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Valider le paiement</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Adn6891d7ueH8UQvV04FwJ6Lr0Bg" crossorigin="anonymous"></script>
</body>
</html>
