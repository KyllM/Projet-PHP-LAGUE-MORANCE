<?php
session_start();
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // On récupère les infos du CD à partir du formulaire
    $article = [
        'id' => $_POST['idCD'],
        'titre' => $_POST['titreCD'],
        'auteur' => $_POST['auteurCD'],
        'genre' => $_POST['genreCD'],
        'prix' => $_POST['prixCD'],
        'lienImage' => $_POST['lienImage']
    ];

    // Ajouter l'article dans la session "panier"
    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }
    $_SESSION['panier'][] = $article;

    // Redirection pour éviter la resoumission du formulaire
    header('Location: panier.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Page d'accueil - Vente de CD</title>
</head>
<body>
<div class="container">
    <h1 class="text-center my-4">Bienvenue sur notre boutique de CD</h1>
    <nav class="mb-4 d-flex justify-content-between">
        <div>
            <a href="panier.php" class="btn btn-primary">Voir le panier</a>
            <a href="page_paiement.php" class="btn btn-success">Page de paiement</a>
        </div>
        
        <div>
            <?php if (isset($_SESSION['login'])): ?>
                <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
            <?php else: ?>
                <a href="login.php?page=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-success">Se connecter</a>
            <?php endif; ?>
        </div>
    </nav>

    <h2 class="mb-3">CD disponibles à l'achat</h2>

        
    <div class='row'>
        <?php


            $host = 'lakartxela';
            $username = 'kmorance_bd';
            $passwrd = 'kmorance_bd';
            $database = 'kmorance_bd';

            $conn = new mysqli($host, $username, $passwrd, $database);

            if ($conn == true) {

                $donneesCD = "SELECT * FROM CD";

                $donneesCD = $conn->query($donneesCD);
               


                // Utiliser fetch_assoc au lieu du switch case
                while($donnees=mysqli_fetch_assoc($donneesCD))
                {
     
                    echo "
                        <div class='col-md-4 mb-4'>
                            <div class='card'>
                                <img src='".$donnees['lienImage']."' class='card-img-top' alt='".$donnees['titreCD']."'>
                                <div class='card-body'>
                                    <h5 class='card-title'>".$donnees['titreCD']."</h5>
                                    <p class='card-text'>Artiste : ".$donnees['auteurCD']."</p>
                                    <p class='card-text'>Genre : ".$donnees['genreCD']."</p>
                                    <p class='card-text'>Prix : ".$donnees['prixCD']." €</p>
                                    <form method='POST' action='page_accueil.php'>
                                    <input type='hidden' name='idCD' value=".$donnees['idCD'].">
                                    <input type='hidden' name='titreCD' value=".$donnees['titreCD'].">
                                    <input type='hidden' name='auteurCD' value=".$donnees['auteurCD'].">
                                    <input type='hidden' name='genreCD' value=".$donnees['genreCD'].">
                                    <input type='hidden' name='prixCD' value=".$donnees['prixCD'].">
                                    <input type='hidden' name='lienImage' value=".$donnees['lienImage'].">
                                    <button type='submit' class='btn btn-primary'>Ajouter au panier</button>
                                </form>
                                </div>
                            </div>
                        </div>
                    ";
                }

                $conn->close();

            }
            ?>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Adn6891d7ueH8UQvV04FwJ6Lr0Bg" crossorigin="anonymous"></script>
</body>

</html>