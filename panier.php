<?php
include 'verif.php';
// Gestion de la suppression d'un article du panier
if (isset($_GET['index'])) {
    // Récupérer l'index de l'article à supprimer
    $index = $_GET['index'];
    if (isset($_SESSION['panier'][$index])) {

        unset($_SESSION['panier'][$index]);
        
        $_SESSION['panier'] = array_values($_SESSION['panier']);
    }
    // Redirection pour éviter de réappliquer la suppression lors du rafraîchissement de la page
    header('Location: panier.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="largeur=device-largeur, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Panier - Vente de CD</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Bienvenue sur notre boutique de CD</h1>
        
        <nav class="mb-4 d-flex justify-content-between">
            <div>
                <a href="page_accueil.php" class="btn btn-primary">Voir la page d'accueil</a>
                <a href="page_paiement.php" class="btn btn-success">Page de paiement</a>
            </div>
            <div>
                <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
            </div>
        </nav>

        <h2 class="mb-3">Votre panier</h2>

        <div class="row">
            <div class="col-md-4 mb-4">
                <?php 
                function resizeImage($cheminDAcces, $imageDestination, $nouvelleLargeur, $nouvelleHauteur) {
                    // Vérifiez si l'image source existe
                    if (!file_exists($cheminDAcces)) {
                        die("L'image source n'existe pas.");
                    }
                
                    // Obtenir les dimensions de l'image source
                    list($largeur, $hauteur) = getimagesize($cheminDAcces);
                    
                    // Créer une nouvelle image vide avec les dimensions souhaitées
                    $nouvelleImage = imagecreatetruecolor($nouvelleLargeur, $nouvelleHauteur);
                    
                    // Déterminer le type d'image et charger l'image source
                    $imageType = pathinfo($cheminDAcces, PATHINFO_EXTENSION);
                    switch (strtolower($imageType)) {
                        case 'jpeg':
                        case 'jpg':
                            $imageSource = imagecreatefromjpeg($cheminDAcces);
                            break;
                        case 'png':
                            $imageSource = imagecreatefrompng($cheminDAcces);
                            break;
                        default:
                            die("Type d'image non supporté.");
                    }
                
                    // Redimensionner l'image
                    imagecopyresampled($nouvelleImage, $imageSource, 0, 0, 0, 0, $nouvelleLargeur, $nouvelleHauteur, $largeur, $hauteur);
                    
                    // Sauvegarder l'image redimensionnée
                    switch (strtolower($imageType)) {
                        case 'jpeg':
                        case 'jpg':
                            imagejpeg($nouvelleImage, $imageDestination);
                            break;
                        case 'png':
                            imagepng($nouvelleImage, $imageDestination);
                            break;
                    }
                
                    // Libérer la mémoire
                    imagedestroy($imageSource);
                    imagedestroy($nouvelleImage);
                }
                echo "
                <table class='table'>
                <thead class='thead-dark'>
                  <tr>
                    <th scope='col'>Image</th>
                    <th scope='col'>Titre</th>
                    <th scope='col'>Auteur</th>
                    <th scope='col'>Genre</th>
                    <th scope='col'>Prix</th>
                    <th scope='col'></th>
                  </tr>
                </thead>
                <tbody>";
                if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])):
                    foreach ($_SESSION['panier'] as $index => $article):
                        
                    
                        // Utilisation de la fonction
                        $imageSource = $article['lienImage'];  // Chemin de l'image source
                        $imageDestination = explode('.',$article['lienImage'])[0]."_vignette.jpg";  // Chemin de la vignette de destination
                        $largeurVignette = 50;  // Largeur de la vignette
                        $hauteurVignette = 50;  // Hauteur de la vignette
                        

                        resizeImage($imageSource, $imageDestination, $largeurVignette, $hauteurVignette);

                        echo "<tr>
                            <th scope='row'><img src='".$article['lienImage']."' class='card-img-top' alt=".$article['titre']."></th>
                            <td>".$article['titre']."</td>
                            <td>".$article['auteur']."</td>
                            <td>".$article['genre']."</td>
                            <td>".$article['prix']."</td>
                            <td><a href='panier.php?index=".$index."' class='btn btn-primary'>Supprimer l'article</a></td>
                          </tr>";

                    endforeach;
                    echo "
                    </tbody>
                  </table>";

                else:
                    echo "<p>Votre panier est vide.</p>";
                endif;
                ?>
            </div>
        
        </div>

        <div class="text-end mb-4">
            <a href="page_paiement.php" class="btn btn-success">Valider le panier</a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Adn6891d7ueH8UQvV04FwJ6Lr0Bg" crossorigin="anonymous"></script>
</body>
</html>
