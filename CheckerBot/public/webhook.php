<?php
// Cargar variables de entorno
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

// Conectar a la base de datos PostgreSQL
$connectionString = "host=$host port=$port dbname=$dbname user=$user password=$pass";
$conn = pg_connect($connectionString);

if (!$conn) {
    die("Error al conectar a la base de datos: " . pg_last_error());
}

echo "Conexión exitosa a PostgreSQL";
?>
