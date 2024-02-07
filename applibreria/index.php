<?php
include("includes/db.php"); // Include il file di connessione al database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_book_id"])) {
    $editBookId = $_POST["edit_book_id"];
    header("Location: books/edit_book_form.php?id=$editBookId");
    exit();}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libreriacss/libreria.css">
    <title>Library App</title>
</head>
<body>
    <h1>Elenco Libri</h1>

    <?php
    // Recupera tutti i libri dal database
    


    $query = "SELECT * FROM libri";
    $result = $mysqli->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>{$row['titolo']} - {$row['autore']} ({$row['anno_pubblicazione']}) - {$row['genere']}";

            // Aggiungi un pulsante per modificare il libro
            echo "<form action='index.php' method='post' style='display:inline; margin-left: 10px;'>";
            echo "<input type='hidden' name='edit_book_id' value='{$row['id']}'>";
            echo "<input type='submit' value='Modifica'>";
            echo "</form>";

            echo "</p>";
        }
    } else {
        echo "Errore nella query: " . $mysqli->error;
    }
    $mysqli->close();
    ?>

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