<?php
   $config = [
    "mysql_host" => "localhost",
    "mysql_user" => "root",
    "mysql_password" => "",
    
];

$mysqli = new mysqli(
    $config["mysql_host"],
    $config["mysql_user"],
    $config["mysql_password"],
);

if($mysqli->connect_error){
    die($mysqli->connect_error);
}else{
    //var_dump($mysqli);
}

$sql="CREATE DATABASE IF NOT EXISTS mia_libreria ";
$mysqli->query($sql);
//se la query non va a buon fine
if(!$mysqli->query($sql)){
    die( $mysqli->connect_error);
}

// seleziono i DB
$sql = "USE mia_libreria;";
$mysqli->query($sql);

//creo una tabella
$sql = 'CREATE TABLE IF NOT EXISTS libri( 
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    titolo VARCHAR(255) NOT NULL,
    autore VARCHAR(255) NOT NULL,
    anno_pubblicazione INT NOT NULL,
    genere VARCHAR(255) NOT NULL
)';
if(!$mysqli->query($sql)){
    die( $mysqli->connect_error);
};
?>
