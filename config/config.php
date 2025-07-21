<?php

/**
 * Función para cargar variables de entorno desde archivo .env
 * @param string $path Ruta al archivo .env
 * @throws Exception Si el archivo no existe
 */
function loadEnv($path) {
    if (!file_exists($path)) {
        throw new Exception("Archivo .env no encontrado en: $path");
    }
    
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar comentarios
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Verificar que la línea contiene un =
        if (strpos($line, '=') === false) {
            continue;
        }
        
        // Separar clave=valor
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        // Remover comillas si existen
        $value = trim($value, '"\'');
        
        // Establecer variable de entorno
        $_ENV[$name] = $value;
        putenv("$name=$value");
    }
}

// Cargar variables de entorno
try {
    loadEnv(__DIR__ . '/../.env');
} catch (Exception $e) {
    // Si no existe .env, mostrar error útil
    die("Error: " . $e->getMessage() . "\n\nPor favor:\n1. Copia .env.example a .env\n2. Configura tus credenciales de base de datos");
}

// Configuración de base de datos usando variables de entorno
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_PORT', $_ENV['DB_PORT'] ?? '5432');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'torneo_futbol');
define('DB_USER', $_ENV['DB_USER'] ?? 'postgres');
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? '');

// Configuración de aplicación
define('APP_ENV', $_ENV['APP_ENV'] ?? 'production');
define('APP_DEBUG', $_ENV['APP_DEBUG'] === 'true');

/**
 * Función para obtener conexión PDO con la configuración cargada
 * @return PDO Conexión a la base de datos
 * @throws Exception Si hay error en la conexión
 */
function getConnection() {
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
    
    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT => false
        ]);
        return $pdo;
    } catch (PDOException $e) {
        throw new Exception("Error de conexión a la base de datos: " . $e->getMessage());
    }
}

/**
 * Función helper para debug (solo en desarrollo)
 * @param mixed $data Datos a mostrar
 * @param bool $die Si debe terminar la ejecución
 */
function debug($data, $die = false) {
    if (APP_DEBUG) {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        if ($die) die();
    }
}