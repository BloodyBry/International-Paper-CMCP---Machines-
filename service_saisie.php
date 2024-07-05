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
    <title>Enregistrement de Machine</title>
    <!-- Inclure Bootstrap, Font Awesome et Google Fonts -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Styles communs */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: auto; /* Permettre le défilement */
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
            padding: 20px 50px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            overflow: auto; /* Permettre le défilement */
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            margin-top: 20px; /* Ajustement de la marge supérieure */
            text-align: center;
            color: #00695c;
            opacity: 0; /* Défaut à 0 pour l'animation */
            animation: fadeInDown 1s ease-in-out forwards; /* Appliquez l'animation */
        }
        form {
            max-width: 500px;
            width: 100%;
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto; /* Permettre le défilement si nécessaire */
        }
        form input[type="text"],
        form input[type="date"],
        form input[type="number"],
        form input[type="file"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .action-btn {
            background: #00695c;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }
        .action-btn:hover {
            background-color: #004d40;
            transform: scale(1.05);
        }
        .action-btn i {
            margin-right: 10px;
        }
        a {
            color: #00695c;
            text-decoration: none;
            display: block;
            text-align: center;
        }
        a:hover {
            text-decoration: none;
        }
        /* Keyframe animations */
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
    <div class="main-content">
        <h1>Enregistrement de Machine</h1>
        <form method="post" action="donnees_enregistrees.php" enctype="multipart/form-data">
            <input type="text" name="nom_machine" placeholder="Nom de la machine" required>
            <textarea name="description_machine" placeholder="Description de la machine" required></textarea>
            <input type="date" name="date_achat" required>
            <!-- Nouveaux champs -->
            <input type="number" name="Mois" placeholder="Mois" min="1" max="12">
            <input type="number" name="Production_Brut" placeholder="Production Brut">
            <input type="number" name="Production_Net_Bob" placeholder="Production Net Bob">
            <input type="number" name="Production_Net_Finish" placeholder="Production Net Finish">
            <input type="number" name="Consommation_MP" placeholder="Consommation MP">
            <input type="number" name="Rendement_fibreux_percent" placeholder="Rendement fibreux %">
            <input type="number" name="Tonnage_livree_casa" placeholder="Tonnage livrée casa">
            <input type="number" name="Tonnage_livree_Agadir" placeholder="Tonnage livrée Agadir">
            <input type="number" name="Tonnage_livree_tanger" placeholder="Tonnage livrée tanger">
            <input type="number" name="Total_livree" placeholder="Total livrée">
            <input type="number" name="Total_livree_cumul" placeholder="Total livrée cumul">
            <input type="number" name="Total_Rebobinee" placeholder="Total Rebobinée">
            <input type="number" name="PM3_productivity_finished_Ton_Day" placeholder="PM3 productivity finished Ton/Day">
            <input type="number" name="Taux_dechet_BOB" placeholder="Taux déchet BOB">
            <input type="number" name="Taux_dechet_Glob" placeholder="Taux déchet Glob">
            <input type="number" name="Taux_d_allure" placeholder="Taux d'allure">
            <input type="number" name="Speed_OME" placeholder="Speed OME">
            <input type="number" name="Disponibilite" placeholder="Disponibilité">
            <input type="number" name="Performance" placeholder="Performance">
            <input type="number" name="Stock_final" placeholder="Stock final">
            <input type="number" name="RUD" placeholder="RUD">
            <input type="number" name="Grammage_moy_g_m2" placeholder="Grammage moy g/m2">
            <input type="number" name="laize_moy_cm" placeholder="laize moy cm">
            <input type="number" name="Conso_eaux_m3_T" placeholder="Conso eaux m3/T">
            <input type="number" name="Conso_amidon" placeholder="Conso amidon">
            <input type="number" name="Conso_VAP" placeholder="Conso VAP">
            <input type="number" name="Conso_KWH" placeholder="Conso KWH">
            <input type="number" name="Mecanique" placeholder="Mécanique">
            <input type="number" name="elec_autom" placeholder="elec / autom">
            <input type="number" name="RAK" placeholder="RAK">
            <input type="number" name="Energie" placeholder="Energie">
            <input type="number" name="Habillage" placeholder="Habillage">
            <input type="number" name="Chang_fab" placeholder="Chang fab">
            <input type="number" name="Cable" placeholder="Cable">
            <input type="number" name="Nbre_Casses" placeholder="Nbre Casses">
            <input type="number" name="Taux_Casses" placeholder="Taux Casses">
            <input type="number" name="Production" placeholder="Production">
            <input type="number" name="Nbre_Reclamation" placeholder="Nbre Réclamation">
            <input type="file" name="image_machine" accept=".jpg, .jpeg, .png"> <!-- Champ pour l'importation de l'image -->

            <button type="submit" name="submit" class="action-btn"><i class="fas fa-save"></i> Enregistrer</button>
        </form>

        <br><a href="index.php"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
    </div>

    <!-- Inclure les scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
