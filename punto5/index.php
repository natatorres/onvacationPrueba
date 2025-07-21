<?php
require_once __DIR__ . '/src/CalculadorComisiones.php';
require_once __DIR__ . '/src/CalculadorComisionesInterface.php';

use Punto5\CalculadorComisiones;

$ventas = $_POST['ventas'] ?? '';
$meta = $_POST['meta'] ?? '';
$comisionBase = $_POST['comision_base'] ?? '';
$resultado = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (is_numeric($ventas) && is_numeric($meta) && is_numeric($comisionBase)) {
        $calculadora = new CalculadorComisiones();
        $resultado = $calculadora->calcular($ventas, $meta, $comisionBase);
    } else {
        $error = "Por favor ingrese valores numéricos válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto 5 - Calculo de Comisiones</title>
    <style>
        body { font-family: Arial; margin: 2rem; }
        label { display: block; margin-top: 1rem; }
        input { padding: 6px; margin-top: 4px; width: 150px; }
        .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>
<h2>Punto 5: Cálculo de Comisiones del Vendedor</h2>
<a href="../index.php">Volver al menú principal</a>

<form method="POST">
    <label>Ventas realizadas:
        <input type="number" name="ventas" value="<?= htmlspecialchars($ventas) ?>">
    </label>
    <label>Meta mensual:
        <input type="number" name="meta" value="<?= htmlspecialchars($meta) ?>">
    </label>
    <label>Comisión base ($):
        <input type="number" name="comision_base" value="<?= htmlspecialchars($comisionBase) ?>">
    </label>
    <button type="submit">Calcular</button>
</form>

<?php if ($error): ?>
    <p class="error"><?= $error ?></p>
<?php elseif ($resultado !== null): ?>
    <h3>Resultado:</h3>
    <p>Porcentaje de cumplimiento: <strong><?= $resultado['porcentaje'] ?>%</strong></p>
    <p>Porcentaje aplicado a la comisión: <strong><?= $resultado['porcentaje_pago'] ?>%</strong></p>
    <p>Comisión final a pagar: <strong>$<?= number_format($resultado['comision_final'], 2) ?></strong></p>
<?php endif; ?>

</body>
</html>
