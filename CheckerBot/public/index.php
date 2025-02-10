<?php

// Obtener las credenciales del bot y la base de datos desde las variables de entorno
$token = getenv('TELEGRAM_BOT_TOKEN');
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');

// Verificar si las credenciales están configuradas correctamente
if (empty($token) || empty($host) || empty($port) || empty($user) || empty($password) || empty($database)) {
    die("❌ Error: No se encontraron las credenciales.");
}

