<?php
/**
 * Vista y Controlador - Crear Cliente
 */
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/classes/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$error = "";

if ($_POST) {
    $cliente->nombre = $_POST['nombre'] ?? '';
    $cliente->email = $_POST['email'] ?? '';
    $cliente->telefono = $_POST['telefono'] ?? '';
    $cliente->direccion = $_POST['direccion'] ?? '';

    if (!empty($cliente->nombre) && !empty($cliente->email) && !empty($cliente->telefono) && !empty($cliente->direccion)) {
        try {
            if ($cliente->crear()) {
                header("Location: index.php?mensaje=creado");
                exit();
            } else {
                $error = "No se pudo registrar el cliente. Verifique que el correo electrónico no esté duplicado.";
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
    <title>Nuevo Cliente - CRUD POO PHP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container" style="max-width: 700px;">
        <div class="card">
            <div class="header-flex">
                <h2>Registrar Nuevo Cliente</h2>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="create.php" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($_POST['telefono'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <textarea id="direccion" name="direccion" rows="3" required><?php echo htmlspecialchars($_POST['direccion'] ?? ''); ?></textarea>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
