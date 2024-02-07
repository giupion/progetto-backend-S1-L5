<?php
include("../includes/db.php"); // Supponendo che il file db.php sia nella directory principale
include("../header.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_book_id"])) {
    $editBookId = $_POST["edit_book_id"];
    header("Location: edit_book.php?id=$editBookId");
    exit();
}
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
        header("refresh:2;url=../listalibri.php");
    
        
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Modifica Libro</title>
</head>
<body>
    
    <h1 class="mb-4">Modifica Libro</h1>
    <button class="btn btn-primary" style='width: 18rem;' >
<a href="../index.php" class="text-white text-decoration-none">Torna alla pagina aggiungi Libro</a></button>
<form action="edit_book.php?id=<?php echo $bookId; ?>" method="post">
    <div class="form-group">
        <label for="titolo">Titolo:</label>
        <input type="text" class="form-control" name="titolo" value="<?php echo $bookData['titolo']; ?>" required>
    </div>

    <div class="form-group">
        <label for="autore">Autore:</label>
        <input type="text" class="form-control" name="autore" value="<?php echo $bookData['autore']; ?>" required>
    </div>

    <div class="form-group">
        <label for="anno_pubblicazione">Anno di Pubblicazione:</label>
        <input type="number" class="form-control" name="anno_pubblicazione" value="<?php echo $bookData['anno_pubblicazione']; ?>" required>
    </div>

    <div class="form-group">
        <label for="genere">Genere:</label>
        <input type="text" class="form-control" name="genere" value="<?php echo $bookData['genere']; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Salva Modifiche</button>
</form>
</body>
</html>

<?php
$mysqli->close();


include("../footer.php");


  
?>
