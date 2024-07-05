<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: login.php');
        exit;
    }  
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intranet CMCP</title>
    <link rel="icon" href="th.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            background-color: #f4f4f9;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #00695c;
            padding: 15px 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            height: 50px;
            transition: transform 0.3s ease-in-out;
        }
        
        .logo:hover {
            transform: scale(1.1);
        }
        
        .header-buttons {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .search-bar {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            color: #00695c;
            outline: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease-in-out;
        }
        
        .search-bar:focus {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            background: white;
            color: #00695c;
            font-size: 16px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s, color 0.3s;
        }
        
        .btn:hover {
            background-color: #004d40;
            color: white;
        }
        
        .disconnect a {
            color: inherit;
            text-decoration: none;
        }
        
        .main-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex: 1;
            padding: 50px;
            background: linear-gradient(to right, rgba(255, 255, 255, 1) 40%, rgba(255, 255, 255, 0) 100%), url('tswira.jpg') no-repeat center right;
            background-size: contain;
            position: relative;
            height: calc(100vh - 80px);
        }
        
        .text-content {
            max-width: 50%;
            color: #004d40;
            z-index: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            padding-right: 30px;
        }
        
        h1 {
            font-size: 3.5em;
            margin-bottom: 20px;
            line-height: 1.2;
            animation: fadeInDown 1s ease-in-out;
        }
        
        p {
            font-size: 1.8em;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-in-out;
        }
        
        .buttons {
            margin-top: 30px;
            display: flex;
            gap: 20px;
        }
        
        .action-btn a {
            color: white;
            text-decoration: none;
        }
        
        .action-btn {
            background: #00695c;
            padding: 20px 40px;
            border: none;
            border-radius: 30px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
        }

        .action-btn:hover {
            background-color: #004d40;
            transform: scale(1.05);
        }
        
        .action-btn i {
            margin-right: 10px;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="index.php"><img src="whitelogo.png" alt="International Paper Logo" class="logo"></a>
            <div class="header-buttons">
                <button class="btn disconnect"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> SE DÉCONNECTER</a></button>
            </div>
        </div>
    </header>
    <main>
        <div class="main-content">
            <div class="text-content">
                <h1>Bienvenue sur votre Intranet CMCP</h1>
                <p>Que souhaitez-vous faire aujourd'hui ?</p>
                <div class="buttons">
                    <button class="action-btn"><a href="service_saisie.php"><i class="fas fa-pencil-alt"></i> Ajouter Machines</a></button>
                    <button class="action-btn"><a href="listes_machines.php"><i class="fas fa-list"></i> Liste des Machines</a></button>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
