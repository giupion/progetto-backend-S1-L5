<?php
include("includes/db.php");

// Verifica se il modulo di modifica è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_book_id"])) {
    $editBookId = $_POST["edit_book_id"];
    header("Location: books/edit_book.php?id=$editBookId");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libreriacss/libreria.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>App Biblioteca</title>
</head>
<body>
<h2>Aggiungi Nuovo Libro</h2>
<form action="books/add_book.php" method="post" class="mt-4">
    <div class="mb-3">
        <label for="titolo" class="form-label">Titolo:</label>
        <input type="text" class="form-control" name="titolo" required>
    </div>
    
    <div class="mb-3">
        <label for="autore" class="form-label">Autore:</label>
        <input type="text" class="form-control" name="autore" required>
    </div>
    
    <div class="mb-3">
        <label for="anno_pubblicazione" class="form-label">Anno di Pubblicazione:</label>
        <input type="number" class="form-control" name="anno_pubblicazione" required>
    </div>
    
    <div class="mb-3">
        <label for="genere" class="form-label">Genere:</label>
        <input type="text" class="form-control" name="genere" required>
    </div>

    <button type="submit" class="btn btn-primary">Aggiungi Libro</button>
</form>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</html>


    
  