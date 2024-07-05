<?php
// Vérification si l'ID de la machine à supprimer est défini
if (isset($_POST['id'])) {
    // Récupération de l'ID de la machine à supprimer
    $id = $_POST['id'];

    // Connexion à la base de données
    $connexion = new mysqli("localhost", "root", "", "machines");

    // Vérification de la connexion
    if ($connexion->connect_error) {
        die("Erreur de connexion à la base de données : " . $connexion->connect_error);
    }

    // Préparation de la requête SQL de suppression
    $sql = "DELETE FROM machines_saisies WHERE id = ?";

    // Préparation de la requête SQL avec une instruction préparée
    $stmt = $connexion->prepare($sql);

    // Liaison des paramètres
    $stmt->bind_param("i", $id);

    // Exécution de la requête préparée
    if ($stmt->execute()) {
        // Affichage d'un message de succès
        echo '<script>alert("Machine supprimée avec succès.")</script>';
    } else {
        // Affichage d'un message d'erreur en cas d'échec
        echo '<script>alert("Erreur lors de la suppression de la machine.")</script>';
    }

    // Fermeture de la requête préparée
    $stmt->close();

    // Fermeture de la connexion à la base de données
    $connexion->close();

    // Redirection vers la page liste_machines.php après la suppression
    echo '<script>window.location.replace("listes_machines.php");</script>';
    exit();
} else {
    // Si l'ID n'est pas défini, afficher un message d'erreur ou rediriger vers une autre page
}
?>
