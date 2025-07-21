<?php
require_once __DIR__ . '/src/EquiposVisitantesFrecuentes.php';

$dsn = "pgsql:host=localhost;port=5432;dbname=torneo_futbol"; 
$user = "postgres";
$password = "Natalia057";

$resultados = [];
$error = null;

try {
    $pdo = new PDO($dsn, $user, $password);
    $consulta = new EquiposVisitantesFrecuentes();
    $resultados = $consulta->obtenerResultados($pdo);
} catch (PDOException $e) {
    $error = "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto 4 - Equipos con más de 5 partidos como visitante</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        .error { color: red; margin-top: 1rem; }
    </style>
</head>
<body>

<h2>Punto 4: Equipos con más de 5 partidos como visitante</h2>
<a href="../index.php">Volver al menú principal</a>

<?php if ($error): ?>
    <div class="error"><?= $error ?></div>
<?php elseif (count($resultados) === 0): ?>
    <p>No hay equipos que hayan jugado más de 5 partidos como visitante.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Cantidad de partidos como visitante</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $fila): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['nombre_equipo']) ?></td>
                    <td><?= $fila['cantidad_partidos'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
