<?php
include("includes/db.php");
include("header.php");


?>


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




<?php

include("footer.php");

?>
  