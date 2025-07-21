<?php

require_once __DIR__ . '/src/Verificador.php';

$verificador = new Verificador();
$resultado = null;
$entrada = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entrada = trim($_POST['cadena'] ?? '');
    $resultado = $verificador->verificar($entrada);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto 1 - Verificador</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        input[type="text"] {
            width: 60%; padding: 0.5rem;
        }
        .btn {
            margin-top: 10px; padding: 8px 16px;
        }
        .resultado {
            margin-top: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
        }
        .true { color: green; }
        .false { color: red; }
    </style>
</head>
<body>

<h2>Punto 1: Verificar si hay 3 signos de interrogación entre números que sumen 10</h2>

<form method="POST">
    <input type="text" name="cadena" placeholder="Ej: acc?7??sss?3rr1??????5" required
           value="<?= htmlspecialchars($entrada) ?>">
    <br>
    <button type="submit" class="btn">Verificar</button>
</form>

<?php if ($resultado !== null): ?>
    <div class="resultado <?= $resultado === 'true' ? 'true' : 'false' ?>">
        Resultado: <?= $resultado === 'true' ? '✅ true' : '❌ false' ?>
    </div>
<?php endif; ?>

</body>
</html>
