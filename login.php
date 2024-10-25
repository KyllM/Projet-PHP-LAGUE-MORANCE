<?php
session_start();
$login_valide = "theo";
$pwd_valide = "theolague";
$admin_user = "admin";
$admin_pwd = "adminn";

if (isset($_POST['login']) && isset($_POST['pwd'])) {
    if ($_POST['login'] == $login_valide && $_POST['pwd'] == $pwd_valide) {
        $_SESSION['login'] = $_POST['login'];
        $redirectPage = isset($_GET['page']) ? $_GET['page'] : 'page_accueil.php';
        header("Location: $redirectPage");
        exit();
    } elseif ($_POST['login'] == $admin_user && $_POST['pwd'] == $admin_pwd) {
        $_SESSION['admin'] = true;
        header("Location: gestion_cd.php"); 
        exit();
    } else {
        $error_message = "<p style='color:red;'>Identifiant ou mot de passe incorrect.</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Connexion</title>
</head>
<body>
<div class="container">
    <h1 class="text-center my-4">Connexion</h1>
    
    <?php 
    if (isset($error_message)) {
        echo $error_message; 
    }
    ?>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" id="username" name="login" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="pwd" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+Adn6891d7ueH8UQvV04FwJ6Lr0Bg" crossorigin="anonymous"></script>
</body>
</html>
