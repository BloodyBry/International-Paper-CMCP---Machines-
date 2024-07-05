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
    <title>Liste des Machines</title>
    <link rel="icon" href="th.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
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
            padding: 30px 50px;
            background: white;
            margin: 20px 50px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Centre le contenu principal */
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            margin-top: 20px;
            text-align: center;
            color: #00695c;
            opacity: 0; /* Défaut à 0 pour l'animation */
            animation: fadeInDown 1s ease-in-out forwards; /* Applique l'animation */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            text-align: left;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            transition: background-color 0.3s;
        }

        th {
            background-color: #00695c;
            color: white;
        }

        tr:hover td {
            background-color: #f4f4f4;
        }

        .btn-container {
            margin-top: 20px;
            text-align: center;
        }

        .btn-container form {
            display: flex;
            gap: 10px;
        }

        .actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .actions button {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .actions button i {
            margin-right: 5px;
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

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
            background-color: #00695c;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .pagination a:hover {
            background-color: #004d40;
        }

        .pagination strong {
            margin: 0 5px;
            padding: 5px 10px;
            background-color: #004d40;
            color: white;
            border-radius: 5px;
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
    <h1>Liste des Machines</h1>
    <table>
        <thead>
            <tr>
                <th>Nom de la machine</th>
                <th>Description</th>
                <th>Date d'achat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            $connexion = new mysqli("localhost", "root", "", "machines");

            // Vérifier la connexion
            if ($connexion->connect_error) {
                die("Erreur de connexion à la base de données : " . $connexion->connect_error);
            }

            // Définir le nombre de machines par page
            $machines_par_page = 5;

            // Récupérer le numéro de la page actuelle depuis les paramètres GET, sinon par défaut à 1
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            // Calculer le décalage (offset)
            $offset = ($page - 1) * $machines_par_page;

            // Récupérer le nombre total de machines
            $total_machines_result = $connexion->query("SELECT COUNT(*) as total FROM machines_saisies");
            $total_machines = $total_machines_result->fetch_assoc()['total'];

            // Calculer le nombre total de pages
            $total_pages = ceil($total_machines / $machines_par_page);

            // Récupérer les machines pour la page actuelle avec LIMIT et OFFSET
            $sql = "SELECT * FROM machines_saisies LIMIT $machines_par_page OFFSET $offset";
            $result = $connexion->query($sql);

            if ($result->num_rows > 0) {
                // Afficher les machines si des résultats sont trouvés
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["nom_machine"] . "</td>";
                    echo "<td>" . $row["description_machine"] . "</td>";
                    echo "<td>" . $row["date_achat"] . "</td>";
                    
                    echo '<td class="actions">';


                    // Modification
                    echo '<form method="get" action="modification_machine.php">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="btn edit-btn"><i class="fas fa-edit"></i> Modifier</button>';
                    echo '</form>';

                    // Voir
                    echo '<form method="get" action="donnees_enregistrees.php">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="btn view-btn"><i class="fas fa-eye"></i> Voir</button>';
                    echo '</form>';

                    // Suppression
                    echo '<form id="deleteForm_' . $row["id"] . '" method="post" action="delete_machines.php">';
                    echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                    echo '<button type="button" class="btn delete-btn" onclick="confirmDelete(' . $row["id"] . ')"><i class="fas fa-trash-alt"></i> Supprimer</button>';
                    echo '</form>';


                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucune machine enregistrée.</td></tr>";
            }

            // Fermer la connexion
            $connexion->close();
            ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<strong>$i</strong> ";
            } else {
                echo "<a href=\"listes_machines.php?page=$i\">$i</a> ";
            }
        }
        ?>
    </div>
    <br><a href="index.php"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette machine ?")) {
            document.getElementById("deleteForm_" + id).submit();
        }
    }
</script>
<!-- Inclure les scripts Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
