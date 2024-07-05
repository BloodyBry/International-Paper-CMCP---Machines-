<?php
if (isset($_GET['id'])) {
    $id_machine = $_GET['id'];
    require 'vendor/autoload.php';

    $connexion = new mysqli("localhost", "root", "", "machines");

    if ($connexion->connect_error) {
        die("Erreur de connexion à la base de données : " . $connexion->connect_error);
    }

    $stmt = $connexion->prepare("SELECT * FROM machines_saisies WHERE id = ?");
    $stmt->bind_param("i", $id_machine);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Définir les en-têtes
        $sheet->setCellValue('A1', 'Nom de la machine');
        $sheet->setCellValue('B1', 'Description');
        $sheet->setCellValue('C1', 'Date d\'achat');
        $sheet->setCellValue('D1', 'Mois');
        $sheet->setCellValue('E1', 'Production Brut');
        $sheet->setCellValue('F1', 'Production Net Bob');
        $sheet->setCellValue('G1', 'Production Net Finish');
        $sheet->setCellValue('H1', 'Consommation MP');
        $sheet->setCellValue('I1', 'Rendement fibreux (%)');
        $sheet->setCellValue('J1', 'Tonnage livrée Casa');
        $sheet->setCellValue('K1', 'Tonnage livrée Agadir');
        $sheet->setCellValue('L1', 'Tonnage livrée Tanger');
        $sheet->setCellValue('M1', 'Total livrée');
        $sheet->setCellValue('N1', 'Total livrée cumul');
        $sheet->setCellValue('O1', 'Total Rebobinee');
        $sheet->setCellValue('P1', 'PM3 productivity finished (Ton/Day)');
        $sheet->setCellValue('Q1', 'Taux déchet BOB');
        $sheet->setCellValue('R1', 'Taux déchet Glob');
        $sheet->setCellValue('S1', 'Taux d\'allure');
        $sheet->setCellValue('T1', 'Speed OME');
        $sheet->setCellValue('U1', 'Disponibilité');
        $sheet->setCellValue('V1', 'Performance');
        $sheet->setCellValue('W1', 'Stock final');
        $sheet->setCellValue('X1', 'RUD');
        $sheet->setCellValue('Y1', 'Grammage moy (g/m2)');
        $sheet->setCellValue('Z1', 'Laize moy (cm)');
        $sheet->setCellValue('AA1', 'Conso eaux (m3/T)');
        $sheet->setCellValue('AB1', 'Conso amidon');
        $sheet->setCellValue('AC1', 'Conso VAP');
        $sheet->setCellValue('AD1', 'Conso KWH');
        $sheet->setCellValue('AE1', 'Mécanique');
        $sheet->setCellValue('AF1', 'Élec/Autom');
        $sheet->setCellValue('AG1', 'RAK');
        $sheet->setCellValue('AH1', 'Énergie');
        $sheet->setCellValue('AI1', 'Habillage');
        $sheet->setCellValue('AJ1', 'Changement de fabrication');
        $sheet->setCellValue('AK1', 'Câble');
        $sheet->setCellValue('AL1', 'Nombre de Casses');
        $sheet->setCellValue('AM1', 'Taux de Casses');
        $sheet->setCellValue('AN1', 'Production');
        $sheet->setCellValue('AO1', 'Nombre de Réclamations');
        $sheet->setCellValue('AP1', 'Image');

        // Remplir les données
        $sheet->setCellValue('A2', $row['nom_machine']);
        $sheet->setCellValue('B2', $row['description_machine']);
        $sheet->setCellValue('C2', $row['date_achat']);
        $sheet->setCellValue('D2', $row['Mois']);
        $sheet->setCellValue('E2', $row['Production_Brut']);
        $sheet->setCellValue('F2', $row['Production_Net_Bob']);
        $sheet->setCellValue('G2', $row['Production_Net_Finish']);
        $sheet->setCellValue('H2', $row['Consommation_MP']);
        $sheet->setCellValue('I2', $row['Rendement_fibreux_percent']);
        $sheet->setCellValue('J2', $row['Tonnage_livree_casa']);
        $sheet->setCellValue('K2', $row['Tonnage_livree_Agadir']);
        $sheet->setCellValue('L2', $row['Tonnage_livree_tanger']);
        $sheet->setCellValue('M2', $row['Total_livree']);
        $sheet->setCellValue('N2', $row['Total_livree_cumul']);
        $sheet->setCellValue('O2', $row['Total_Rebobinee']);
        $sheet->setCellValue('P2', $row['PM3_productivity_finished_Ton_Day']);
        $sheet->setCellValue('Q2', $row['Taux_dechet_BOB']);
        $sheet->setCellValue('R2', $row['Taux_dechet_Glob']);
        $sheet->setCellValue('S2', $row['Taux_d_allure']);
        $sheet->setCellValue('T2', $row['Speed_OME']);
        $sheet->setCellValue('U2', $row['Disponibilite']);
        $sheet->setCellValue('V2', $row['Performance']);
        $sheet->setCellValue('W2', $row['Stock_final']);
        $sheet->setCellValue('X2', $row['RUD']);
        $sheet->setCellValue('Y2', $row['Grammage_moy_g_m2']);
        $sheet->setCellValue('Z2', $row['laize_moy_cm']);
        $sheet->setCellValue('AA2', $row['Conso_eaux_m3_T']);
        $sheet->setCellValue('AB2', $row['Conso_amidon']);
        $sheet->setCellValue('AC2', $row['Conso_VAP']);
        $sheet->setCellValue('AD2', $row['Conso_KWH']);
        $sheet->setCellValue('AE2', $row['Mecanique']);
        $sheet->setCellValue('AF2', $row['elec_autom']);
        $sheet->setCellValue('AG2', $row['RAK']);
        $sheet->setCellValue('AH2', $row['Energie']);
        $sheet->setCellValue('AI2', $row['Habillage']);
        $sheet->setCellValue('AJ2', $row['Chang_fab']);
        $sheet->setCellValue('AK2', $row['Cable']);
        $sheet->setCellValue('AL2', $row['Nbre_Casses']);
        $sheet->setCellValue('AM2', $row['Taux_Casses']);
        $sheet->setCellValue('AN2', $row['Production']);
        $sheet->setCellValue('AO2', $row['Nbre_Reclamation']);
        $sheet->setCellValue('AP2', $row['image_path']);

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'machine_' . $id_machine . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
        $writer->save('php://output');
    } else {
        echo "Aucune donnée trouvée pour cette machine.";
    }

    $stmt->close();
    $connexion->close();
}
?>
