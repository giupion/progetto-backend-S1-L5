<?php
include("includes/db.php");

// Verifica se il modulo di modifica è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edit_book_id"])) {
    $editBookId = $_POST["edit_book_id"];
    header("Location: books/edit_book.php?id=$editBookId");
    exit();
}
?>
<h1>Lista Libri</h1>
<button class="btn btn-success" style='width: 18rem;' >
<a href="index.php" class="text-white text-decoration-none">Torna alla pagina aggiungi Libro</a></button>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <?php
    // Recupera tutti i libri dal database
    $query = "SELECT * FROM libri";
    $result = $mysqli->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card' style='width: 18rem;'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title' style='font-weight: bold;'>Titolo: {$row['titolo']}</h5>";
            echo "<div  class='card-text d-flex flex-column'>
            <p>Autore: {$row['autore']}</p>
              <p>Anno: {$row['anno_pubblicazione']} </p>
               <p>Genere: {$row['genere']}</p>";
            echo "</div>";
            // Aggiungi un pulsante per modificare il libro
            echo "<div class='d-flex justify-content-between'>";
            echo "<form action='index.php' method='post'>";
            echo "<input type='hidden' name='edit_book_id' value='{$row['id']}'>";
            echo "<input type='submit' class='btn btn-primary' value='Modifica'>";
            echo "</form>";
            
            // Aggiungi un pulsante per eliminare il libro
            echo "<form action='books/delete_book.php' method='get'>";
            echo "<input type='hidden' name='id' value='{$row['id']}'>";
            echo "<input type='submit' class='btn btn-danger' value='Elimina'>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "Errore nella query: " . $mysqli->error;
    }

    $mysqli->close();
    ?>
