<?php

require_once __DIR__ . '/src/CalculadoraMatriz.php';

$matriz = [];
$resultado = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = $_POST['matriz'] ?? [];
    $matriz = [];

    // Validar y construir la matriz
    foreach ($datos as $fila) {
        $filaNumeros = array_map('intval', $fila);
        if (count($filaNumeros) !== 3) {
            $error = "Cada fila debe tener 3 valores.";
            break;
        }
        $matriz[] = $filaNumeros;
    }

    if (count($matriz) === 4) {
        $calculadora = new CalculadoraMatriz();
        $min = $calculadora->obtenerMinimo($matriz);
        $max = $calculadora->obtenerMaximo($matriz);
        $suma = $calculadora->sumar($min, $max);
        $resultado = [
            'min' => $min,
            'max' => $max,
            'suma' => $suma
        ];
    } else {
        $error = "Se requieren 4 filas de 3 números cada una.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Matriz 3x4 - Mini Proyecto</title>
    <style>
        table { border-collapse: collapse; margin-top: 20px; }
        td { padding: 5px; }
        input[type="number"] { width: 60px; text-align: center; }
        .btn { margin-top: 15px; padding: 8px 12px; }
        .resultado { margin-top: 20px; font-size: 1.1rem; }
        .error { color: red; }
    </style>
</head>
<body>
<h2>Formulario para matriz 3 × 4</h2>

<form method="POST">
    <table>
        <tbody>
        <?php for ($i = 0; $i < 4; $i++): ?>
            <tr>
                <?php for ($j = 0; $j < 3; $j++): ?>
                    <td>
                        <input type="number" name="matriz[<?= $i ?>][<?= $j ?>]"
                               value="<?= htmlspecialchars($matriz[$i][$j] ?? '') ?>" required>
                    </td>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
    <button type="submit" class="btn">Calcular</button>
</form>

<?php if ($error): ?>
    <div class="error"><?= $error ?></div>
<?php endif; ?>

<?php if ($resultado): ?>
    <div class="resultado">
        <p>Mínimo: <strong><?= $resultado['min'] ?></strong></p>
        <p>Máximo: <strong><?= $resultado['max'] ?></strong></p>
        <p>Suma total: <strong><?= $resultado['suma'] ?></strong></p>
    </div>
<?php endif; ?>

</body>
</html>
