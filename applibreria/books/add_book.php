<?php
include("../includes/db.php"); // 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati del modulo
    $titolo = $_POST["titolo"];
    $autore = $_POST["autore"];
    $anno_pubblicazione = $_POST["anno_pubblicazione"];
    $genere = $_POST["genere"];

    // Inserisce il nuovo libro nel database
    $insertQuery = "INSERT INTO libri (titolo, autore, anno_pubblicazione, genere) VALUES ('$titolo', '$autore', '$anno_pubblicazione', '$genere')";
    
    if ($mysqli->query($insertQuery)) {
        echo "Libro aggiunto con successo!";
        header("Location:  ../listalibri.php");} else {
        echo "Errore nell'aggiunta del libro: " . $mysqli->error;
    }
    
    $mysqli->close();
} else {
    // Se il modulo non è inviato tramite POST, reindirizza alla pagina principale
    header("Location: ../index.php");
    exit();
}
?>

