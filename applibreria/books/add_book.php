<?php
include("../includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati del modulo
    $errors = [];

    // Funzione di validazione per le lettere minuscole
    function validateLowerCase($value, $fieldName)
    {
        if (!ctype_lower($value)) {
            return "Il campo $fieldName deve contenere solo lettere minuscole.";
        }
        return "";
    }

    $titolo = trim($_POST["titolo"]);
    $autore = trim($_POST["autore"]);
    $anno_pubblicazione = trim($_POST["anno_pubblicazione"]);
    $genere = trim($_POST["genere"]);

    // Validazione dei campi
    $errors[] = validateLowerCase($titolo, "Titolo");
    $errors[] = validateLowerCase($autore, "Autore");

    if (empty($anno_pubblicazione)) {
        $errors[] = "Il campo Anno di Pubblicazione è obbligatorio.";
    }

    $errors[] = validateLowerCase($genere, "Genere");

    // Rimuovi eventuali stringhe per SQL injection
    $titolo = $mysqli->real_escape_string($titolo);
    $autore = $mysqli->real_escape_string($autore);
    $anno_pubblicazione = $mysqli->real_escape_string($anno_pubblicazione);
    $genere = $mysqli->real_escape_string($genere);

    // Verifica se ci sono errori di validazione
    $filteredErrors = array_filter($errors);
    if (!empty($filteredErrors)) {
        foreach ($filteredErrors as $error) {
            echo "<p>$error</p>";
        }
    } else {
        // Inserisce il nuovo libro nel database
        $insertQuery = "INSERT INTO libri (titolo, autore, anno_pubblicazione, genere) VALUES ('$titolo', '$autore', '$anno_pubblicazione', '$genere')";

        if ($mysqli->query($insertQuery)) {
            echo "Libro aggiunto con successo!";
            header("Location: ../listalibri.php");
        } else {
            echo "Errore nell'aggiunta del libro: " . $mysqli->error;
        }

        $mysqli->close();
    }
} else {
    // Se il modulo non è inviato tramite POST, reindirizza alla pagina principale
    header("Location: ../index.php");
    exit();
}
?>
