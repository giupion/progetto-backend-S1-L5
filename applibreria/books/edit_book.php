<?php
include("../includes/db.php"); // Supponendo che il file db.php sia nella directory principale

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati del modulo
    $id = $_POST["id"];
    $titolo = $_POST["titolo"];
    $autore = $_POST["autore"];
    $anno_pubblicazione = $_POST["anno_pubblicazione"];
    $genere = $_POST["genere"];

    // Aggiorna le informazioni del libro nel database
    $updateQuery = "UPDATE libri SET titolo='$titolo', autore='$autore', anno_pubblicazione='$anno_pubblicazione', genere='$genere' WHERE id=$id";
    
    if ($mysqli->query($updateQuery)) {
        echo "Libro aggiornato con successo!";
    } else {
        echo "Errore nell'aggiornamento del libro: " . $mysqli->error;
    }
    
    $mysqli->close();
} else {
    // Se il modulo non è inviato tramite POST, reindirizza alla pagina principale
    header("Location: ../index.php");
    exit();
}
?>
