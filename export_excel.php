<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require 'vendor/autoload.php'; // Include PhpSpreadsheet's autoloader

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture all posted parameters
    $required_fields = [
        "nom_machine", "description_machine", "date_achat", "mois", "production_brut",
        "production_net_bob", "production_net_finish", "consommation_mp", "rendement_fibreux_percent",
        "tonnage_livree_casa", "tonnage_livree_agadir", "tonnage_livree_tanger", "total_livree",
        "total_livree_cumul", "total_rebobinee", "pm3_productivity_finished_ton_day", "taux_dechet_bob",
        "taux_dechet_glob", "taux_d_allure", "speed_ome", "disponibilite", "performance", "stock_final",
        "rud", "grammage_moy_g_m2", "laize_moy_cm", "conso_eaux_m3_t", "conso_amidon", "conso_vap",
        "conso_kwh", "mecanique", "elec_autom", "rak", "energie", "habillage", "chang_fab", "cable",
        "nbre_casses", "taux_casses", "production", "nbre_reclamation"
    ];

    $data = [];
    foreach ($required_fields as $field) {
        if (isset($_POST[$field])) {
            $data[$field] = $_POST[$field];
        } else {
            $data[$field] = null;
        }
    }

    // Database connection
    $connexion = new mysqli("localhost", "root", "", "machines");

    if ($connexion->connect_error) {
        die("Erreur de connexion à la base de données : " . $connexion->connect_error);
    }

    // Check if the necessary parameters are defined
    if (isset($data["nom_machine"]) && !empty($data["nom_machine"])) {
        // SQL query to select the specific machine
        $sql = "SELECT * FROM machines_saisies WHERE nom_machine = '" . $connexion->real_escape_string($data["nom_machine"]) . "'";
        $result = $connexion->query($sql);

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add headers to spreadsheet
        $headers = [
            'Nom de la machine', 'Description de la machine', 'Date d\'achat', 'Mois',
            'Production brut', 'Production net bobines', 'Production net fini', 'Consommation matières premières',
            'Rendement fibreux (%)', 'Tonnage livré à Casa', 'Tonnage livré à Agadir', 'Tonnage livré à Tanger',
            'Total livré', 'Total livré cumulé', 'Total rebobinée', 'Productivité PM3 (tonnes/jour)',
            'Taux de déchet bobines (%)', 'Taux de déchet global (%)', 'Taux d\'allure (%)', 'Vitesse OME',
            'Disponibilité (%)', 'Performance (%)', 'Stock final', 'RUD', 'Grammage moyen (g/m²)', 'Laize moyenne (cm)',
            'Consommation eaux (m³/t)', 'Consommation amidon', 'Consommation vapeur', 'Consommation énergie (kWh)',
            'Mécanique (%)', 'Electrique/Automatique (%)', 'Rak', 'Energie', 'Habillage', 'Changement de fabrication',
            'Câble', 'Nombre de casses', 'Taux de casses (%)', 'Production', 'Nombre de réclamation'
        ];

        $columnIndex = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($columnIndex . '1', $header);
            $columnIndex++;
        }

        // Populate the spreadsheet with data
        if ($result->num_rows > 0) {
            $row = 2;
            while ($row_data = $result->fetch_assoc()) {
                $columnIndex = 'A';
                foreach ($required_fields as $field) {
                    $sheet->setCellValue($columnIndex . $row, $row_data[$field] ?? $data[$field]);
                    $columnIndex++;
                }
                $row++;
            }
        } else {
            $columnIndex = 'A';
            foreach ($required_fields as $field) {
                $sheet->setCellValue($columnIndex . '2', $data[$field]);
                $columnIndex++;
            }
        }

        // Set the response headers
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="machine_data.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    } else {
        echo "Le nom de la machine n'est pas spécifié.";
    }

    // Close the database connection
    $connexion->close();
} else {
    // If the request method is not POST, redirect the user to another page or display an error message
    echo "Méthode de requête invalide.";
}
?>


