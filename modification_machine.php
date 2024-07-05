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
    <title>Modification de Machine</title>
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
            height: 100vh;
            overflow: hidden;
            background-color: #f4f4f9;
            overflow: auto;
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
            margin-top: 20px;
            text-align: center;
            color: #00695c;
            opacity: 0;
            animation: fadeInDown 1s ease-in-out forwards;
        }
        form {
            max-width: 500px;
            width: 100%;
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form input[type="text"],
        form input[type="date"],
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
        <h1>Modification de Machine</h1>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $connexion = new mysqli("localhost", "root", "", "machines");
            if ($connexion->connect_error) {
                die("Erreur de connexion à la base de données : " . $connexion->connect_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nom_machine = $_POST["nom_machine"];
                $description_machine = $_POST["description_machine"];
                $date_achat = $_POST["date_achat"];

                // Champs récemment ajoutés
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

                // Gestion du fichier d'image
                if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                    $image_tmp_name = $_FILES['image']['tmp_name'];
                    $image_name = basename($_FILES['image']['name']);
                    $image_dir = 'uploads/';
                    $image_path = $image_dir . $image_name;

                    // Déplace le fichier téléchargé dans le répertoire des images
                    if (move_uploaded_file($image_tmp_name, $image_path)) {
                        // Met à jour la base de données avec le chemin de l'image
                        $sql = "UPDATE machines_saisies SET nom_machine='$nom_machine', description_machine='$description_machine', date_achat='$date_achat', image_path='$image_path', Mois='$mois', Production_Brut='$production_brut', Production_Net_Bob='$production_net_bob', Production_Net_Finish='$production_net_finish', Consommation_MP='$consommation_mp', Rendement_fibreux_percent='$rendement_fibreux_percent', Tonnage_livree_casa='$tonnage_livree_casa', Tonnage_livree_Agadir='$tonnage_livree_agadir', Tonnage_livree_tanger='$tonnage_livree_tanger', Total_livree='$total_livree', Total_livree_cumul='$total_livree_cumul', Total_Rebobinee='$total_rebobinee', PM3_productivity_finished_Ton_Day='$pm3_productivity_finished_ton_day', Taux_dechet_BOB='$taux_dechet_bob', Taux_dechet_Glob='$taux_dechet_glob', Taux_d_allure='$taux_d_allure', Speed_OME='$speed_ome', Disponibilite='$disponibilite', Performance='$performance', Stock_final='$stock_final', RUD='$rud', Grammage_moy_g_m2='$grammage_moy_g_m2', laize_moy_cm='$laize_moy_cm', Conso_eaux_m3_T='$conso_eaux_m3_t', Conso_amidon='$conso_amidon', Conso_VAP='$conso_vap', Conso_KWH='$conso_kwh', Mecanique='$mecanique', elec_autom='$elec_autom', RAK='$rak', Energie='$energie', Habillage='$habillage', Chang_fab='$chang_fab', Cable='$cable', Nbre_Casses='$nbre_casses', Taux_Casses='$taux_casses', Production='$production', Nbre_Reclamation='$nbre_reclamation' WHERE id=$id";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Erreur lors du téléchargement de l'image.</div>";
                        $sql = "UPDATE machines_saisies SET nom_machine='$nom_machine', description_machine='$description_machine', date_achat='$date_achat', Mois='$mois', Production_Brut='$production_brut', Production_Net_Bob='$production_net_bob', Production_Net_Finish='$production_net_finish', Consommation_MP='$consommation_mp', Rendement_fibreux_percent='$rendement_fibreux_percent', Tonnage_livree_casa='$tonnage_livree_casa', Tonnage_livree_Agadir='$tonnage_livree_agadir', Tonnage_livree_tanger='$tonnage_livree_tanger', Total_livree='$total_livree', Total_livree_cumul='$total_livree_cumul', Total_Rebobinee='$total_rebobinee', PM3_productivity_finished_Ton_Day='$pm3_productivity_finished_ton_day', Taux_dechet_BOB='$taux_dechet_bob', Taux_dechet_Glob='$taux_dechet_glob', Taux_d_allure='$taux_d_allure', Speed_OME='$speed_ome', Disponibilite='$disponibilite', Performance='$performance', Stock_final='$stock_final', RUD='$rud', Grammage_moy_g_m2='$grammage_moy_g_m2', laize_moy_cm='$laize_moy_cm', Conso_eaux_m3_T='$conso_eaux_m3_t', Conso_amidon='$conso_amidon', Conso_VAP='$conso_vap', Conso_KWH='$conso_kwh', Mecanique='$mecanique', elec_autom='$elec_autom', RAK='$rak', Energie='$energie', Habillage='$habillage', Chang_fab='$chang_fab', Cable='$cable', Nbre_Casses='$nbre_casses', Taux_Casses='$taux_casses', Production='$production', Nbre_Reclamation='$nbre_reclamation' WHERE id=$id";
                    }
                } else {
                    $sql = "UPDATE machines_saisies SET nom_machine='$nom_machine', description_machine='$description_machine', date_achat='$date_achat', Mois='$mois', Production_Brut='$production_brut', Production_Net_Bob='$production_net_bob', Production_Net_Finish='$production_net_finish', Consommation_MP='$consommation_mp', Rendement_fibreux_percent='$rendement_fibreux_percent', Tonnage_livree_casa='$tonnage_livree_casa', Tonnage_livree_Agadir='$tonnage_livree_agadir', Tonnage_livree_tanger='$tonnage_livree_tanger', Total_livree='$total_livree', Total_livree_cumul='$total_livree_cumul', Total_Rebobinee='$total_rebobinee', PM3_productivity_finished_Ton_Day='$pm3_productivity_finished_ton_day', Taux_dechet_BOB='$taux_dechet_bob', Taux_dechet_Glob='$taux_dechet_glob', Taux_d_allure='$taux_d_allure', Speed_OME='$speed_ome', Disponibilite='$disponibilite', Performance='$performance', Stock_final='$stock_final', RUD='$rud', Grammage_moy_g_m2='$grammage_moy_g_m2', laize_moy_cm='$laize_moy_cm', Conso_eaux_m3_T='$conso_eaux_m3_t', Conso_amidon='$conso_amidon', Conso_VAP='$conso_vap', Conso_KWH='$conso_kwh', Mecanique='$mecanique', elec_autom='$elec_autom', RAK='$rak', Energie='$energie', Habillage='$habillage', Chang_fab='$chang_fab', Cable='$cable', Nbre_Casses='$nbre_casses', Taux_Casses='$taux_casses', Production='$production', Nbre_Reclamation='$nbre_reclamation' WHERE id=$id";
                }

                if ($connexion->query($sql) === TRUE) {
                    echo "<div class='alert alert-success' role='alert'>Machine mise à jour avec succès !</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Erreur lors de la mise à jour de la machine : " . $connexion->error . "</div>";
                }
            }

            $sql = "SELECT * FROM machines_saisies WHERE id=$id";
            $result = $connexion->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="text" name="nom_machine" value="<?php echo $row['nom_machine']; ?>" placeholder="Nom de la machine" required>
                    <textarea name="description_machine" placeholder="Description de la machine" required><?php echo $row['description_machine']; ?></textarea>
                    <input type="date" name="date_achat" value="<?php echo $row['date_achat']; ?>" required>
                    <!-- Nouveaux champs ajoutés -->
                    <input type="text" name="Mois" value="<?php echo $row['Mois']; ?>" placeholder="Mois" min="1" max="12">
                    <input type="text" name="Production_Brut" value="<?php echo $row['Production_Brut']; ?>" placeholder="Production Brut">
                    <input type="text" name="Production_Net_Bob" value="<?php echo $row['Production_Net_Bob']; ?>" placeholder="Production Net Bob">
                    <input type="text" name="Production_Net_Finish" value="<?php echo $row['Production_Net_Finish']; ?>" placeholder="Production Net Finish">
                    <input type="text" name="Consommation_MP" value="<?php echo $row['Consommation_MP']; ?>" placeholder="Consommation MP">
                    <input type="text" name="Rendement_fibreux_percent" value="<?php echo $row['Rendement_fibreux_percent']; ?>" placeholder="Rendement fibreux %">
                    <input type="text" name="Tonnage_livree_casa" value="<?php echo $row['Tonnage_livree_casa']; ?>" placeholder="Tonnage livrée Casa">
                    <input type="text" name="Tonnage_livree_Agadir" value="<?php echo $row['Tonnage_livree_Agadir']; ?>" placeholder="Tonnage livrée Agadir">
                    <input type="text" name="Tonnage_livree_tanger" value="<?php echo $row['Tonnage_livree_tanger']; ?>" placeholder="Tonnage livrée Tanger">
                    <input type="text" name="Total_livree" value="<?php echo $row['Total_livree']; ?>" placeholder="Total livrée">
                    <input type="text" name="Total_livree_cumul" value="<?php echo $row['Total_livree_cumul']; ?>" placeholder="Total livrée cumul">
                    <input type="text" name="Total_Rebobinee" value="<?php echo $row['Total_Rebobinee']; ?>" placeholder="Total Rebobinée">
                    <input type="text" name="PM3_productivity_finished_Ton_Day" value="<?php echo $row['PM3_productivity_finished_Ton_Day']; ?>" placeholder="PM3 productivity finished Ton/Day">
                    <input type="text" name="Taux_dechet_BOB" value="<?php echo $row['Taux_dechet_BOB']; ?>" placeholder="Taux déchet BOB">
                    <input type="text" name="Taux_dechet_Glob" value="<?php echo $row['Taux_dechet_Glob']; ?>" placeholder="Taux déchet Glob">
                    <input type="text" name="Taux_d_allure" value="<?php echo $row['Taux_d_allure']; ?>" placeholder="Taux d'allure">
                    <input type="text" name="Speed_OME" value="<?php echo $row['Speed_OME']; ?>" placeholder="Speed OME">
                    <input type="text" name="Disponibilite" value="<?php echo $row['Disponibilite']; ?>" placeholder="Disponibilité">
                    <input type="text" name="Performance" value="<?php echo $row['Performance']; ?>" placeholder="Performance">
                    <input type="text" name="Stock_final" value="<?php echo $row['Stock_final']; ?>" placeholder="Stock final">
                    <input type="text" name="RUD" value="<?php echo $row['RUD']; ?>" placeholder="RUD">
                    <input type="text" name="Grammage_moy_g_m2" value="<?php echo $row['Grammage_moy_g_m2']; ?>" placeholder="Grammage moy g/m2">
                    <input type="text" name="laize_moy_cm" value="<?php echo $row['laize_moy_cm']; ?>" placeholder="laize moy cm">
                    <input type="text" name="Conso_eaux_m3_T" value="<?php echo $row['Conso_eaux_m3_T']; ?>" placeholder="Conso eaux m3/T">
                    <input type="text" name="Conso_amidon" value="<?php echo $row['Conso_amidon']; ?>" placeholder="Conso amidon">
                    <input type="text" name="Conso_VAP" value="<?php echo $row['Conso_VAP']; ?>" placeholder="Conso VAP">
                    <input type="text" name="Conso_KWH" value="<?php echo $row['Conso_KWH']; ?>" placeholder="Conso KWH">
                    <input type="text" name="Mecanique" value="<?php echo $row['Mecanique']; ?>" placeholder="Mécanique">
                    <input type="text" name="elec_autom" value="<?php echo $row['elec_autom']; ?>" placeholder="Élec/Autom">
                    <input type="text" name="RAK" value="<?php echo $row['RAK']; ?>" placeholder="RAK">
                    <input type="text" name="Energie" value="<?php echo $row['Energie']; ?>" placeholder="Énergie">
                    <input type="text" name="Habillage" value="<?php echo $row['Habillage']; ?>" placeholder="Habillage">
                    <input type="text" name="Chang_fab" value="<?php echo $row['Chang_fab']; ?>" placeholder="Changement fabrication">
                    <input type="text" name="Cable" value="<?php echo $row['Cable']; ?>" placeholder="Câble">
                    <input type="text" name="Nbre_Casses" value="<?php echo $row['Nbre_Casses']; ?>" placeholder="Nombre de casses">
                    <input type="text" name="Taux_Casses" value="<?php echo $row['Taux_Casses']; ?>" placeholder="Taux de casses">
                    <input type="text" name="Production" value="<?php echo $row['Production']; ?>" placeholder="Production">
                    <input type="text" name="Nbre_Reclamation" value="<?php echo $row['Nbre_Reclamation']; ?>" placeholder="Nombre de réclamation">
                    <input type="file" name="image" accept="image/*">
                    <button type="submit" class="action-btn"><i class="fas fa-save"></i> Mettre à jour</button>
                </form>
                <?php
            } else {
                echo "<div class='alert alert-danger' role='alert'>Aucune machine trouvée avec cet ID.</div>";
            }
            $connexion->close();
        } else {
            echo "<div class='alert alert-danger' role='alert'>ID de machine non fourni.</div>";
        }
        ?>
        <br>
        <a href="index.php"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
    </div>
</body>
</html>
