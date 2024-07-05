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
    <title>Données Enregistrées</title>
    <link rel="icon" href="th.png" type="image/png">
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
            min-height: 100vh;
            overflow: auto;
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
            overflow: auto;
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
        .machine-info {
            max-width: 600px;
            width: 100%;
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: auto;
        }
        .machine-info img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 20px;
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
        }
        .action-btn:hover {
            background-color: #004d40;
            transform: scale(1.05);
        }
        .action-btn i {
            margin-right: 10px;
        }
        .new-machine-btn {
            background: #00796b;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .new-machine-btn:hover {
            background-color: #005b4f;
        }
        .new-machine-btn i {
            margin-right: 10px;
        }
        a {
            color: #00695c;
            text-decoration: none;
            display: block;
            text-align: center;
        }
        a:hover {
            text-decoration: underline;
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
        <h1>Données Enregistrées</h1>

        <!-- Ajouter le bouton pour saisir une nouvelle machine -->
        <button class="new-machine-btn" onclick="window.location.href='service_saisie.php'">
            <i class="fas fa-plus"></i><span> Nouvelle machine</span>
        </button>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $nom_machine = $_POST["nom_machine"];
            $description_machine = $_POST["description_machine"];
            $date_achat = $_POST["date_achat"];

            // Récupérer les valeurs des nouveaux champs
            $mois = $_POST["Mois"];
            $production_brut = $_POST["Production_Brut"];
            $production_net_bob = $_POST["Production_Net_Bob"];
            $production_net_finish = $_POST["Production_Net_Finish"];
            $consommation_mp = $_POST["Consommation_MP"];
            $rendement_fibreux_percent = $_POST["Rendement_fibreux_percent"];
            $tonnage_livree_casa = $_POST["Tonnage_livree_casa"];
            $tonnage_livree_agadir = $_POST["Tonnage_livree_Agadir"];
            $tonnage_livree_tanger = $_POST["Tonnage_livree_tanger"];
            $total_livree = $_POST["Total_livree"];
            $total_livree_cumul = $_POST["Total_livree_cumul"];
            $total_rebobinee = $_POST["Total_Rebobinee"];
            $pm3_productivity_finished_ton_day = $_POST["PM3_productivity_finished_Ton_Day"];
            $taux_dechet_bob = $_POST["Taux_dechet_BOB"];
            $taux_dechet_glob = $_POST["Taux_dechet_Glob"];
            $taux_d_allure = $_POST["Taux_d_allure"];
            $speed_ome = $_POST["Speed_OME"];
            $disponibilite = $_POST["Disponibilite"];
            $performance = $_POST["Performance"];
            $stock_final = $_POST["Stock_final"];
            $rud = $_POST["RUD"];
            $grammage_moy_g_m2 = $_POST["Grammage_moy_g_m2"];
            $laize_moy_cm = $_POST["laize_moy_cm"];
            $conso_eaux_m3_t = $_POST["Conso_eaux_m3_T"];
            $conso_amidon = $_POST["Conso_amidon"];
            $conso_vap = $_POST["Conso_VAP"];
            $conso_kwh = $_POST["Conso_KWH"];
            $mecanique = $_POST["Mecanique"];
            $elec_autom = $_POST["elec_autom"];
            $rak = $_POST["RAK"];
            $energie = $_POST["Energie"];
            $habillage = $_POST["Habillage"];
            $chang_fab = $_POST["Chang_fab"];
            $cable = $_POST["Cable"];
            $nbre_casses = $_POST["Nbre_Casses"];
            $taux_casses = $_POST["Taux_Casses"];
            $production = $_POST["Production"];
            $nbre_reclamation = $_POST["Nbre_Reclamation"];

            $connexion = new mysqli("localhost", "root", "", "machines");

            if ($connexion->connect_error) {
                die("Erreur de connexion à la base de données : " . $connexion->connect_error);
            }

            // Taille maximale autorisée en octets (20 Mo)
            $maxFileSize = 20 * 1024 * 1024;

            // Vérification de la taille du fichier
            if ($_FILES["image_machine"]["size"] > $maxFileSize) {
                echo "Désolé, votre fichier est trop volumineux. La taille maximale autorisée est de 20 Mo.";
                exit;
            }

            // Vérification de l'absence d'erreur lors de l'upload
            if ($_FILES["image_machine"]["error"] !== UPLOAD_ERR_OK) {
                echo "Désolé, une erreur s'est produite lors du téléchargement de l'image.";
                exit;
            }

            // Définir le répertoire de destination
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image_machine"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Vérification du type de fichier
            $allowed_types = array("jpg", "jpeg", "png");
            if (!in_array($imageFileType, $allowed_types)) {
                echo "Désolé, seuls les fichiers JPG, JPEG et PNG sont autorisés.";
                exit;
            }

            // Déplacement du fichier téléchargé vers le répertoire cible
            if (!move_uploaded_file($_FILES["image_machine"]["tmp_name"], $target_file)) {
                echo "Désolé, une erreur s'est produite lors du téléchargement de l'image.";
                exit;
            }

            echo '<div class="machine-info">';
            echo '<h4><b>Nom Machine</b> : ' . $nom_machine . '</h4>';
            echo '<h4><b>Description</b> : ' . $description_machine . '</h4>';
            echo '<h4><b>Date d\'achat</b> : ' . $date_achat . '</h4>';
            echo '<h4><b>Mois</b> : ' . $mois . '</h4>';
            echo '<h4><b>Production Brut</b> : ' . $production_brut . '</h4>';
            echo '<h4><b>Production Net Bob</b> : ' . $production_net_bob . '</h4>';
            echo '<h4><b>Production Net Finish</b> : ' . $production_net_finish . '</h4>';
            echo '<h4><b>Consommation MP</b> : ' . $consommation_mp . '</h4>';
            echo '<h4><b>Rendement fibreux %</b> : ' . $rendement_fibreux_percent . '</h4>';
            echo '<h4><b>Tonnage livrée casa</b> : ' . $tonnage_livree_casa . '</h4>';
            echo '<h4><b>Tonnage livrée Agadir</b> : ' . $tonnage_livree_agadir . '</h4>';
            echo '<h4><b>Tonnage livrée tanger</b> : ' . $tonnage_livree_tanger . '</h4>';
            echo '<h4><b>Total livrée</b> : ' . $total_livree . '</h4>';
            echo '<h4><b>Total livrée cumul</b> : ' . $total_livree_cumul . '</h4>';
            echo '<h4><b>Total Rebobinée</b> : ' . $total_rebobinee . '</h4>';
            echo '<h4><b>PM3 productivity finished Ton/Day</b> : ' . $pm3_productivity_finished_ton_day . '</h4>';
            echo '<h4><b>Taux déchet BOB</b> : ' . $taux_dechet_bob . '</h4>';
            echo '<h4><b>Taux déchet Glob</b> : ' . $taux_dechet_glob . '</h4>';
            echo '<h4><b>Taux d\'allure</b> : ' . $taux_d_allure . '</h4>';
            echo '<h4><b>Speed OME</b> : ' . $speed_ome . '</h4>';
            echo '<h4><b>Disponibilité</b> : ' . $disponibilite . '</h4>';
            echo '<h4><b>Performance</b> : ' . $performance . '</h4>';
            echo '<h4><b>Stock final</b> : ' . $stock_final . '</h4>';
            echo '<h4><b>RUD</b> : ' . $rud . '</h4>';
            echo '<h4><b>Grammage moy g/m2</b> : ' . $grammage_moy_g_m2 . '</h4>';
            echo '<h4><b>Laize moy cm</b> : ' . $laize_moy_cm . '</h4>';
            echo '<h4><b>Conso eaux m3/T</b> : ' . $conso_eaux_m3_t . '</h4>';
            echo '<h4><b>Conso amidon</b> : ' . $conso_amidon . '</h4>';
            echo '<h4><b>Conso VAP</b> : ' . $conso_vap . '</h4>';
            echo '<h4><b>Conso KWH</b> : ' . $conso_kwh . '</h4>';
            echo '<h4><b>Mécanique</b> : ' . $mecanique . '</h4>';
            echo '<h4><b>Elec / autom</b> : ' . $elec_autom . '</h4>';
            echo '<h4><b>RAK</b> : ' . $rak . '</h4>';
            echo '<h4><b>Energie</b> : ' . $energie . '</h4>';
            echo '<h4><b>Habillage</b> : ' . $habillage . '</h4>';
            echo '<h4><b>Chang fab</b> : ' . $chang_fab . '</h4>';
            echo '<h4><b>Cable</b> : ' . $cable . '</h4>';
            echo '<h4><b>Nbre Casses</b> : ' . $nbre_casses . '</h4>';
            echo '<h4><b>Taux Casses</b> : ' . $taux_casses . '</h4>';
            echo '<h4><b>Production</b> : ' . $production . '</h4>';
            echo '<h4><b>Nbre Réclamation</b> : ' . $nbre_reclamation . '</h4>';

            echo '<img src="' . $target_file . '" alt="Image de la machine">';

            echo '</div>';

            // Utiliser des requêtes préparées pour insérer les données
            $stmt = $connexion->prepare("INSERT INTO machines_saisies (nom_machine, description_machine, date_achat, image_path, Mois, Production_Brut, Production_Net_Bob, Production_Net_Finish, Consommation_MP, Rendement_fibreux_percent, Tonnage_livree_casa, Tonnage_livree_Agadir, Tonnage_livree_tanger, Total_livree, Total_livree_cumul, Total_Rebobinee, PM3_productivity_finished_Ton_Day, Taux_dechet_BOB, Taux_dechet_Glob, Taux_d_allure, Speed_OME, Disponibilite, Performance, Stock_final, RUD, Grammage_moy_g_m2, laize_moy_cm, Conso_eaux_m3_T, Conso_amidon, Conso_VAP, Conso_KWH, Mecanique, elec_autom, RAK, Energie, Habillage, Chang_fab, Cable, Nbre_Casses, Taux_Casses, Production, Nbre_Reclamation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii", $nom_machine, $description_machine, $date_achat, $target_file, $mois, $production_brut, $production_net_bob, $production_net_finish, $consommation_mp, $rendement_fibreux_percent, $tonnage_livree_casa, $tonnage_livree_agadir, $tonnage_livree_tanger, $total_livree, $total_livree_cumul, $total_rebobinee, $pm3_productivity_finished_ton_day, $taux_dechet_bob, $taux_dechet_glob, $taux_d_allure, $speed_ome, $disponibilite, $performance, $stock_final, $rud, $grammage_moy_g_m2, $laize_moy_cm, $conso_eaux_m3_t, $conso_amidon, $conso_vap, $conso_kwh, $mecanique, $elec_autom, $rak, $energie, $habillage, $chang_fab, $cable, $nbre_casses, $taux_casses, $production, $nbre_reclamation);

            if ($stmt->execute()) {
                // Afficher le bouton d'impression avec les paramètres après la sauvegarde
                echo '<form method="post" action="export_excel.php" style="display: inline;">';
                
                echo '<input type="hidden" name="nom_machine" value="' . $nom_machine . '">';
                echo '<input type="hidden" name="description_machine" value="' . $description_machine . '">';
                echo '<input type="hidden" name="date_achat" value="' . $date_achat . '">';
                echo '<input type="hidden" name="mois" value="' . $mois . '">';
                echo '<input type="hidden" name="production_brut" value="' . $production_brut . '">';
                echo '<input type="hidden" name="production_net_bob" value="' . $production_net_bob . '">';
                echo '<input type="hidden" name="production_net_finish" value="' . $production_net_finish . '">';
                echo '<input type="hidden" name="consommation_mp" value="' . $consommation_mp . '">';
                echo '<input type="hidden" name="rendement_fibreux_percent" value="' . $rendement_fibreux_percent . '">';
                echo '<input type="hidden" name="tonnage_livree_casa" value="' . $tonnage_livree_casa . '">';
                echo '<input type="hidden" name="tonnage_livree_agadir" value="' . $tonnage_livree_agadir . '">';
                echo '<input type="hidden" name="tonnage_livree_tanger" value="' . $tonnage_livree_tanger . '">';
                echo '<input type="hidden" name="total_livree" value="' . $total_livree . '">';
                echo '<input type="hidden" name="total_livree_cumul" value="' . $total_livree_cumul . '">';
                echo '<input type="hidden" name="total_rebobinee" value="' . $total_rebobinee . '">';
                echo '<input type="hidden" name="pm3_productivity_finished_ton_day" value="' . $pm3_productivity_finished_ton_day . '">';
                echo '<input type="hidden" name="taux_dechet_bob" value="' . $taux_dechet_bob . '">';
                echo '<input type="hidden" name="taux_dechet_glob" value="' . $taux_dechet_glob . '">';
                echo '<input type="hidden" name="taux_d_allure" value="' . $taux_d_allure . '">';
                echo '<input type="hidden" name="speed_ome" value="' . $speed_ome . '">';
                echo '<input type="hidden" name="disponibilite" value="' . $disponibilite . '">';
                echo '<input type="hidden" name="performance" value="' . $performance . '">';
                echo '<input type="hidden" name="stock_final" value="' . $stock_final . '">';
                echo '<input type="hidden" name="rud" value="' . $rud . '">';
                echo '<input type="hidden" name="grammage_moy_g_m2" value="' . $grammage_moy_g_m2 . '">';
                echo '<input type="hidden" name="laize_moy_cm" value="' . $laize_moy_cm . '">';
                echo '<input type="hidden" name="conso_eaux_m3_t" value="' . $conso_eaux_m3_t . '">';
                echo '<input type="hidden" name="conso_amidon" value="' . $conso_amidon . '">';
                echo '<input type="hidden" name="conso_vap" value="' . $conso_vap . '">';
                echo '<input type="hidden" name="conso_kwh" value="' . $conso_kwh . '">';
                echo '<input type="hidden" name="mecanique" value="' . $mecanique . '">';
                echo '<input type="hidden" name="elec_autom" value="' . $elec_autom . '">';
                echo '<input type="hidden" name="rak" value="' . $rak . '">';
                echo '<input type="hidden" name="energie" value="' . $energie . '">';
                echo '<input type="hidden" name="habillage" value="' . $habillage . '">';
                echo '<input type="hidden" name="chang_fab" value="' . $chang_fab . '">';
                echo '<input type="hidden" name="cable" value="' . $cable . '">';
                echo '<input type="hidden" name="nbre_casses" value="' . $nbre_casses . '">';
                echo '<input type="hidden" name="taux_casses" value="' . $taux_casses . '">';
                echo '<input type="hidden" name="production" value="' . $production . '">';
                echo '<input type="hidden" name="nbre_reclamation" value="' . $nbre_reclamation . '">';
            
                echo '<button type="submit" class="action-btn"><i class="fas fa-file-excel"></i> Imprimer en Excel</button>';
                echo '</form>';
            } else {
                echo "Erreur : " . $stmt->error;
            }

            $stmt->close();
            $connexion->close();
        }
        ?>

<?php
// Vérification si un ID de machine est passé en GET depuis listes_machines.php
if (isset($_GET['id'])) {
    $id_machine = $_GET['id'];

    // Connexion à la base de données
    $connexion = new mysqli("localhost", "root", "", "machines");

    // Vérifier la connexion
    if ($connexion->connect_error) {
        die("Erreur de connexion à la base de données : " . $connexion->connect_error);
    }

    // Récupérer les données de la machine spécifique
    $stmt = $connexion->prepare("SELECT * FROM machines_saisies WHERE id = ?");
    $stmt->bind_param("i", $id_machine);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Affichage des données de la machine
        echo '<div class="machine-info">';
        echo '<h4><b>Nom Machine : </b>' . $row["nom_machine"] . '</h4>';
        echo '<h4><b>Description : </b>' . $row["description_machine"] . '</h4>';
        echo '<h4><b>Date d\'achat : </b>' . $row["date_achat"] . '</h4>';
        echo '<h4><b>Mois : </b>' . $row["Mois"] . '</h4>';
        echo '<h4><b>Production Brut : </b>' . $row["Production_Brut"] . '</h4>';
        echo '<h4><b>Production Net Bob : </b>' . $row["Production_Net_Bob"] . '</h4>';
        echo '<h4><b>Production Net Finish : </b>' . $row["Production_Net_Finish"] . '</h4>';
        echo '<h4><b>Consommation MP : </b>' . $row["Consommation_MP"] . '</h4>';
        echo '<h4><b>Rendement fibreux (%) : </b>' . $row["Rendement_fibreux_percent"] . '</h4>';
        echo '<h4><b>Tonnage livrée Casa : </b>' . $row["Tonnage_livree_casa"] . '</h4>';
        echo '<h4><b>Tonnage livrée Agadir : </b>' . $row["Tonnage_livree_Agadir"] . '</h4>';
        echo '<h4><b>Tonnage livrée Tanger : </b>' . $row["Tonnage_livree_tanger"] . '</h4>';
        echo '<h4><b>Total livrée : </b>' . $row["Total_livree"] . '</h4>';
        echo '<h4><b>Total livrée cumul : </b>' . $row["Total_livree_cumul"] . '</h4>';
        echo '<h4><b>Total Rebobinee : </b>' . $row["Total_Rebobinee"] . '</h4>';
        echo '<h4><b>PM3 productivity finished (Ton/Day) : </b>' . $row["PM3_productivity_finished_Ton_Day"] . '</h4>';
        echo '<h4><b>Taux déchet BOB : </b>' . $row["Taux_dechet_BOB"] . '</h4>';
        echo '<h4><b>Taux déchet Glob : </b>' . $row["Taux_dechet_Glob"] . '</h4>';
        echo '<h4><b>Taux d\'allure : </b>' . $row["Taux_d_allure"] . '</h4>';
        echo '<h4><b>Speed OME : </b>' . $row["Speed_OME"] . '</h4>';
        echo '<h4><b>Disponibilité : </b>' . $row["Disponibilite"] . '</h4>';
        echo '<h4><b>Performance : </b>' . $row["Performance"] . '</h4>';
        echo '<h4><b>Stock final : </b>' . $row["Stock_final"] . '</h4>';
        echo '<h4><b>RUD : </b>' . $row["RUD"] . '</h4>';
        echo '<h4><b>Grammage moy (g/m2) : </b>' . $row["Grammage_moy_g_m2"] . '</h4>';
        echo '<h4><b>Laize moy (cm) : </b>' . $row["laize_moy_cm"] . '</h4>';
        echo '<h4><b>Conso eaux (m3/T) : </b>' . $row["Conso_eaux_m3_T"] . '</h4>';
        echo '<h4><b>Conso amidon : </b>' . $row["Conso_amidon"] . '</h4>';
        echo '<h4><b>Conso VAP : </b>' . $row["Conso_VAP"] . '</h4>';
        echo '<h4><b>Conso KWH : </b>' . $row["Conso_KWH"] . '</h4>';
        echo '<h4><b>Mécanique : </b>' . $row["Mecanique"] . '</h4>';
        echo '<h4><b>Élec/Autom : </b>' . $row["elec_autom"] . '</h4>';
        echo '<h4><b>RAK : </b>' . $row["RAK"] . '</h4>';
        echo '<h4><b>Énergie : </b>' . $row["Energie"] . '</h4>';
        echo '<h4><b>Habillage : </b>' . $row["Habillage"] . '</h4>';
        echo '<h4><b>Changement de fabrication : </b>' . $row["Chang_fab"] . '</h4>';
        echo '<h4><b>Câble : </b>' . $row["Cable"] . '</h4>';
        echo '<h4><b>Nombre de Casses : </b>' . $row["Nbre_Casses"] . '</h4>';
        echo '<h4><b>Taux de Casses : </b>' . $row["Taux_Casses"] . '</h4>';
        echo '<h4><b>Production : </b>' . $row["Production"] . '</h4>';
        echo '<h4><b>Nombre de Réclamations : </b>' . $row["Nbre_Reclamation"] . '</h4>';

        echo '<img src="' . $row["image_path"] . '" alt="Image de la machine">';

        echo '<button type="button" class="action-btn" onclick="exportToExcel(' . $id_machine . ')"><i class="fas fa-file-excel"></i> Imprimer en Excel</button>';
        
        echo '</div>';
    } else {
        echo "<p>Aucune donnée trouvée pour cette machine.</p>";
    }

    $stmt->close();
    $connexion->close();
}
?>

<script>
function exportToExcel(id) {
    window.location.href = 'export.php?id=' + id;
}
</script>

        


        <br><a href="index.php"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>



