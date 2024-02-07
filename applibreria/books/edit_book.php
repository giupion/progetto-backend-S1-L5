<?php
include("../includes/db.php"); // Supponendo che il file db.php sia nella directory principale

// Verifica se l'ID del libro è stato passato come parametro
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Recupera le informazioni del libro dal database
    $query = "SELECT * FROM libri WHERE id = $bookId";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $bookData = $result->fetch_assoc();
    } else {
        echo "Libro non trovato";
        exit();
    }
} else {
    echo "ID del libro non specificato";
    exit();
}

// Processa il modulo di modifica quando viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati del modulo
    $titolo = $_POST["titolo"];
    $autore = $_POST["autore"];
    $anno_pubblicazione = $_POST["anno_pubblicazione"];
    $genere = $_POST["genere"];

    // Aggiorna le informazioni del libro nel database
    $updateQuery = "UPDATE libri SET titolo='$titolo', autore='$autore', anno_pubblicazione='$anno_pubblicazione', genere='$genere' WHERE id=$bookId";
    
    if ($mysqli->query($updateQuery)) {
        echo "Libro aggiornato con successo!";
        header("refresh:2;url=../index.php");
        exit();
        
    } else {
        echo "Errore nell'aggiornamento del libro: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../libreriacss/libreria.css">
    <title>Modifica Libro</title>
</head>
<body>
    <h1>Modifica Libro</h1>

    <form action="edit_book.php?id=<?php echo $bookId; ?>" method="post">
        Titolo: <input type="text" name="titolo" value="<?php echo $bookData['titolo']; ?>" required><br>
        Autore: <input type="text" name="autore" value="<?php echo $bookData['autore']; ?>" required><br>
        Anno di Pubblicazione: <input type="number" name="anno_pubblicazione" value="<?php echo $bookData['anno_pubblicazione']; ?>" required><br>
        Genere: <input type="text" name="genere" value="<?php echo $bookData['genere']; ?>" required><br>
        <input type="submit" value="Salva Modifiche">
    </form>
</body>
</html>

<?php
$mysqli->close();
?>
