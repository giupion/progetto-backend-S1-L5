<?php
include("includes/db.php"); // Includi il file di connessione al database
include("header.php");
// Query per recuperare gli autori distinti dal database
$query = "SELECT DISTINCT autore FROM libri";
$result = $mysqli->query($query);

// Array per memorizzare gli autori
$autori = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $autori[] = $row['autore'];
    }
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabella Autori</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h1>Tabella Autori</h1>

    <?php
    // Visualizza la tabella solo se ci sono autori
    if (!empty($autori)) {
        foreach ($autori as $autore) {
            echo "<h2>$autore</h2>";
            echo "<table>";
            echo "<tr><th>Titolo</th></tr>";
    
            // Query per recuperare i titoli dei libri per l'autore specifico
            $queryLibri = "SELECT titolo FROM libri WHERE autore='$autore'";
            $resultLibri = $mysqli->query($queryLibri);
    
            if ($resultLibri) {
                while ($rowLibri = $resultLibri->fetch_assoc()) {
                    echo "<tr><td>{$rowLibri['titolo']}</td></tr>";
                }
            }
    
            echo "</table>";
        }
    }
    
    $mysqli->close();

    
