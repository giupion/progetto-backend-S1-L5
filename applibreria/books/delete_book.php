<?php
include("../includes/db.php"); // Supponendo che il file db.php sia nella directory principale

// Verifica se l'ID del libro è stato passato come parametro nella richiesta GET
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Query per eliminare il libro dal database
    $deleteQuery = "DELETE FROM libri WHERE id = $bookId";

    // Esegui la query di eliminazione
    if ($mysqli->query($deleteQuery)) {
        echo "Libro eliminato con successo!";
    } else {
        echo "Errore nell'eliminazione del libro: " . $mysqli->error;
    }
} else {
    echo "ID del libro non specificato";
}

$mysqli->close();
?>


