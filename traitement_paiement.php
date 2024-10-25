<?php
include 'verif.php';

$erreur = false;
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numCarte = $_POST['numCarte'];
    $moisExpiration = $_POST['moisExpiration'];
    $anneeExpiration = $_POST['anneeExpiration'];
    
    if (!preg_match('/^\d{16}$/', $numCarte) || $numCarte[0] !== $numCarte[15]) {
        $erreur = true;
        $message = "Le numéro de la carte est invalide ou le premier chiffre ne correspond pas au dernier.";
    }

    if (!$erreur) {
        $dateExpiration = DateTime::createFromFormat('m/y', $moisExpiration . '/' . $anneeExpiration);
        if (!$dateExpiration) {
            $erreur = true;
            $message = "La date d'expiration est invalide.";
        } else {
            $dateLimite = new DateTime();
            $dateLimite->modify('+3 months');

            if ($dateExpiration < $dateLimite) {
                $erreur = true;
                $message = "La date d'expiration doit être supérieure à " . $dateLimite->format('m/y') . ".";
            }
        }
    }

    if (!$erreur) {
        header("Location: paiement_effectue.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Erreur de Paiement</title>
</head>
<body>
<div class="container">
    <h1 class="text-center my-4">Erreur de Paiement</h1>
    
    <div class="alert alert-danger text-center" role="alert">
        <?php echo $message; ?>
    </div>
    
    <div class="text-center">
        <a href="page_paiement.php" class="btn btn-primary">Retourner à la page de paiement</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Adn6891d7ueH8UQvV04FwJ6Lr0Bg" crossorigin="anonymous"></script>
</body>
</html>
