<?php
session_start();
require_once('config.php');

// If the user is already logged in, redirect to the homepage
if (isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate form fields
        if (empty($name) || empty($email) || empty($password)) {
            $error = "Veuillez remplir tous les champs.";
        } else {
            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Adresse email invalide.";
            } else {
                // Check if user already exists
                $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if ($user) {
                    $error = "Un compte avec cette adresse email existe déjà.";
                } else {
                    // Validate password strength
                    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
                        $error = "Le mot de passe doit contenir au moins 8 caractères, dont au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
                    } else {
                        // Hash the password
                        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                        // Insert user into database
                        $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
                        $stmt->execute([$name, $email, $passwordHash]);

                        // Automatically log in the user after registration
                        $_SESSION['email'] = $email;
                        $_SESSION['name'] = $name;

                        // Redirect to the homepage
                        header('Location: index.php');
                        exit;
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="icon" href="th.png" type="image/png">
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
        .signup-container {
            width: 400px;
            padding: 40px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .signup-container img {
            width: 150px;
            margin-bottom: 20px;
        }
        .signup-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .signup-container button {
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
        .signup-container a {
            display: block;
            margin-top: 20px;
            color: #00695c;
            text-decoration: none;
        }
        .error-message {
            color: red; 
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px; 
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <img src="logo.png" alt="International Paper">
        <form method="post" action="">
            <input type="text" name="name" placeholder="Nom" required>
            <input type="text" name="email" placeholder="Nom d’utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <?php if (isset($error)) { ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php } ?>
            <button type="submit">S’inscrire</button>
        </form>
        <a href="login.php">Déjà inscrit? Se connecter ici</a>
    </div>
</body>
</html>
