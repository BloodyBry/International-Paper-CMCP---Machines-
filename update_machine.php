<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si l'ID, le nom de la machine, la description et la date d'achat ont été soumis
    if (isset($_POST['id']) && isset($_POST['nom_machine']) && isset($_POST['description_machine']) && isset($_POST['date_achat'])) {
        // Récupérer les données depuis le formulaire
        $id = $_POST['id'];
        $new_nom_machine = $_POST['nom_machine'];
        $new_description_machine = $_POST['description_machine'];
        $new_date_achat = $_POST['date_achat'];

        // Nouveaux champs ajoutés
        $mois = $_POST['Mois'];
        $production_brut = $_POST['Production_Brut'];
        $production_net_bob = $_POST['Production_Net_Bob'];
        $production_net_finish = $_POST['Production_Net_Finish'];
        $consommation_mp = $_POST['Consommation_MP'];
        $rendement_fibreux_percent = $_POST['Rendement_fibreux_percent'];
        $tonnage_livree_casa = $_POST['Tonnage_livree_casa'];
        $tonnage_livree_agadir = $_POST['Tonnage_livree_Agadir'];
        $tonnage_livree_tanger = $_POST['Tonnage_livree_tanger'];
        $total_livree = $_POST['Total_livree'];
        $total_livree_cumul = $_POST['Total_livree_cumul'];
        $total_rebobinee = $_POST['Total_Rebobinee'];
        $pm3_productivity_finished_ton_day = $_POST['PM3_productivity_finished_Ton_Day'];
        $taux_dechet_bob = $_POST['Taux_dechet_BOB'];
        $taux_dechet_glob = $_POST['Taux_dechet_Glob'];
        $taux_d_allure = $_POST['Taux_d_allure'];
        $speed_ome = $_POST['Speed_OME'];
        $disponibilite = $_POST['Disponibilite'];
        $performance = $_POST['Performance'];
        $stock_final = $_POST['Stock_final'];
        $rud = $_POST['RUD'];
        $grammage_moy_g_m2 = $_POST['Grammage_moy_g_m2'];
        $laize_moy_cm = $_POST['laize_moy_cm'];
        $conso_eaux_m3_t = $_POST['Conso_eaux_m3_T'];
        $conso_amidon = $_POST['Conso_amidon'];
        $conso_vap = $_POST['Conso_VAP'];
        $conso_kwh = $_POST['Conso_KWH'];
        $mecanique = $_POST['Mecanique'];
        $elec_autom = $_POST['elec_autom'];
        $rak = $_POST['RAK'];
        $energie = $_POST['Energie'];
        $habillage = $_POST['Habillage'];
        $chang_fab = $_POST['Chang_fab'];
        $cable = $_POST['Cable'];
        $nbre_casses = $_POST['Nbre_Casses'];
        $taux_casses = $_POST['Taux_Casses'];
        $production = $_POST['Production'];
        $nbre_reclamation = $_POST['Nbre_Reclamation'];

        // Connexion à la base de données
        $connexion = new mysqli("localhost", "root", "", "machines");

        // Vérification de la connexion
        if ($connexion->connect_error) {
            die("Erreur de connexion à la base de données : " . $connexion->connect_error);
        }

        // Préparer la requête SQL pour mettre à jour les détails de la machine
        $sql = "UPDATE machines_saisies SET nom_machine = ?, description_machine = ?, date_achat = ?, Mois = ?, Production_Brut = ?, Production_Net_Bob = ?, Production_Net_Finish = ?, Consommation_MP = ?, Rendement_fibreux_percent = ?, Tonnage_livree_casa = ?, Tonnage_livree_Agadir = ?, Tonnage_livree_tanger = ?, Total_livree = ?, Total_livree_cumul = ?, Total_Rebobinee = ?, PM3_productivity_finished_Ton_Day = ?, Taux_dechet_BOB = ?, Taux_dechet_Glob = ?, Taux_d_allure = ?, Speed_OME = ?, Disponibilite = ?, Performance = ?, Stock_final = ?, RUD = ?, Grammage_moy_g_m2 = ?, laize_moy_cm = ?, Conso_eaux_m3_T = ?, Conso_amidon = ?, Conso_VAP = ?, Conso_KWH = ?, Mecanique = ?, elec_autom = ?, RAK = ?, Energie = ?, Habillage = ?, Chang_fab = ?, Cable = ?, Nbre_Casses = ?, Taux_Casses = ?, Production = ?, Nbre_Reclamation = ? WHERE id = ?";

        // Préparation de la requête SQL avec une instruction préparée
        $stmt = $connexion->prepare($sql);

        // Liaison des paramètres
        $stmt->bind_param("sssiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii", $new_nom_machine, $new_description_machine, $new_date_achat, $mois, $production_brut, $production_net_bob, $production_net_finish, $consommation_mp, $rendement_fibreux_percent, $tonnage_livree_casa, $tonnage_livree_agadir, $tonnage_livree_tanger, $total_livree, $total_livree_cumul, $total_rebobinee, $pm3_productivity_finished_ton_day, $taux_dechet_bob, $taux_dechet_glob, $taux_d_allure, $speed_ome, $disponibilite, $performance, $stock_final, $rud, $grammage_moy_g_m2, $laize_moy_cm, $conso_eaux_m3_t, $conso_amidon, $conso_vap, $conso_kwh, $mecanique, $elec_autom, $rak, $energie, $habillage, $chang_fab, $cable, $nbre_casses, $taux_casses, $production, $nbre_reclamation, $id);

        // Exécution de la requête préparée
        if ($stmt->execute()) {
            // Redirection vers la page listes_machines.php après la mise à jour
            header("Location: listes_machines.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour de la machine : " . $stmt->error;
        }

        // Fermeture de la requête préparée
        $stmt->close();

        // Fermeture de la connexion à la base de données
        $connexion->close();
    } else {
        echo "ID de machine, nom de machine, description ou date d'achat manquant.";
    }
} else {
    echo "Méthode non autorisée pour accéder à cette page.";
}
?>
