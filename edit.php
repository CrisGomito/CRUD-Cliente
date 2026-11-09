<?php
/**
 * Vista y Controlador - Actualizar Cliente
 */
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/classes/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$id = isset($_GET['id']) ? (int)$_GET['id'] : die('ID no especificado.');
$cliente->id = $id;

if (!$cliente->leerUno()) {
    header("Location: index.php?error=ClienteNoEncontrado");
    exit();
}

$error = "";

if ($_POST) {
    $cliente->nombre = $_POST['nombre'] ?? '';
    $cliente->email = $_POST['email'] ?? '';
    $cliente->telefono = $_POST['telefono'] ?? '';
    $cliente->direccion = $_POST['direccion'] ?? '';

    if (!empty($cliente->nombre) && !empty($cliente->email) && !empty($cliente->telefono) && !empty($cliente->direccion)) {
        try {
            if ($cliente->actualizar()) {
                header("Location: index.php?mensaje=actualizado");
                exit();
            } else {
                $error = "No se pudo actualizar el cliente.";
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Por favor complete todos los campos obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - CRUD POO PHP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 700px;">
        <div class="card">
            <div class="header-flex">
                <h2>Editar Cliente (ID: <?php echo $cliente->id; ?>)</h2>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="edit.php?id=<?php echo $cliente->id; ?>" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente->nombre); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente->email); ?>" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($cliente->telefono); ?>" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <textarea id="direccion" name="direccion" rows="3" required><?php echo htmlspecialchars($cliente->direccion); ?></textarea>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-warning">Actualizar Cliente</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
