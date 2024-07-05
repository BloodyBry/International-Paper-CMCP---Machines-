<?php
session_start();
session_regenerate_id(true);

// Empêcher la mise en cache par le navigateur
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once('config.php');

// Redirection si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

// Traitement du formulaire de connexion
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification des champs email et mot de passe
    if (empty($email) || empty($password)) {
        $error = "Veuillez saisir votre adresse email et votre mot de passe.";
    } else {
        // Recherche de l'utilisateur dans la base de données
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Vérification du mot de passe haché
        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie, enregistrement des données de l'utilisateur dans la session
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];

            // Redirection vers la page d'accueil
            header('Location: index.php');
            exit;
        } else {
            $error = "L'adresse email ou le mot de passe est incorrect.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, #e0f2f1, #b2dfdb);
        }
        .login-container {
            width: 400px;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container img {
            width: 150px;
            margin-bottom: 20px;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background-color: #00695c;
            color: white;
            font-size: 16px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .login-container a {
            display: block;
            margin-top: 20px;
            color: #00695c;
            text-decoration: none;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: left;
            width: 100%;
        }
    </style>
</head>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<body>
    <div class="login-container">
        <img src="logo.png" alt="Logo">
        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Adresse email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <a href="register.php">Pas encore de compte? S’inscrire ici</a>
    </div>
</body>
</html>
