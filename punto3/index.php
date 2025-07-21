<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/src/ConsultaPrimerPartido.php';

$resultados = [];
$error = null;

try {
    $pdo = getConnection();
    $consulta = new ConsultaPrimerPartido();
    $resultados = $consulta->obtenerResultados($pdo);
} catch (PDOException $e) {
    $error = "Error de conexión: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto 3 - Consulta Primer Partido</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        .error { color: red; margin-top: 1rem; }
    </style>
</head>
<body>

<h2>Punto 3: Jugadores, Equipos y Fecha del Primer Partido</h2>

<?php if ($error): ?>
    <div class="error"><?= $error ?></div>
<?php elseif (count($resultados) === 0): ?>
    <p>No se encontraron resultados.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Jugador</th>
                <th>Equipo</th>
                <th>Fecha del Primer Partido</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($resultados as $fila): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['nombre_jugador']) ?></td>
                    <td><?= htmlspecialchars($fila['nombre_equipo']) ?></td>
                    <td><?= htmlspecialchars($fila['fecha_primer_partido']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
