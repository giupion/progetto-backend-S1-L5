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
    <title>App Biblioteca</title>
</head>
<body>
<h2>Aggiungi Nuovo Libro</h2>
    <form action="books/add_book.php" method="post">
        Titolo: <input type="text" name="titolo" required><br>
        Autore: <input type="text" name="autore" required><br>
        Anno di Pubblicazione: <input type="number" name="anno_pubblicazione" required><br>
        Genere: <input type="text" name="genere" required><br>
        <input type="submit" value="Aggiungi Libro">
    </form>
</body>
</html>


    <h1>Elenco Libri</h1>

    <?php
    // Recupera tutti i libri dal database
    $query = "SELECT * FROM libri";
    $result = $mysqli->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<div >";
            echo "<p>Titolo: {$row['titolo']} - Autore: {$row['autore']} -Anno: {$row['anno_pubblicazione']} - Genere: {$row['genere']}</p>";

            // Aggiungi un pulsante per modificare il libro e per eliminare
            echo "<form action='index.php' method='post'>";
            echo "<input type='hidden' name='edit_book_id' value='{$row['id']}'>";
            echo "<input type='submit' value='Modifica'>";
            echo "</form>";
            echo "<form action='books/delete_book.php' method='get'>";
            
            echo "<input type='hidden' name='id' value='{$row['id']}'>";
echo "<input type='submit' value='Elimina'>";
            echo "</form>";

            echo "</div>";
        }
    } else {
        echo "Errore nella query: " . $mysqli->error;
    }

    $mysqli->close();
    ?>

  