<?php
/**
 * Vista Principal - Listado de Clientes
 */
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/classes/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);
$clientes = $cliente->leerTodos();
$num = count($clientes);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Clientes - POO en PHP</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div style="text-align: center; margin-bottom: 25px;">
                <h2>Ingeniería de Software - 6to Semestre</h2>
                <h3 style="color: #4f46e5; margin-top: 5px;">Asignatura: Aplicaciones Web | Tarea CRUD Clientes</h3>
            </div>

            <div class="header-flex">
                <h2>Listado de Clientes</h2>
                <a href="create.php" class="btn btn-primary">+ Nuevo Cliente</a>
            </div>

            <?php if (isset($_GET['mensaje'])): ?>
                <div class="alert alert-success">
                    <?php 
                        if ($_GET['mensaje'] == 'creado') echo "¡Cliente registrado exitosamente!";
                        if ($_GET['mensaje'] == 'actualizado') echo "¡Cliente actualizado exitosamente!";
                        if ($_GET['mensaje'] == 'eliminado') echo "¡Cliente eliminado exitosamente!";
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <?php if ($num > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Fecha Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $row): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($row['nombre']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                                <td><?php echo htmlspecialchars($row['direccion']); ?></td>
                                <td><?php echo $row['fecha_registro']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning" style="padding: 6px 12px; font-size: 12px;">Editar</a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" style="padding: 6px 12px; font-size: 12px;" onclick="return confirm('¿Está seguro de eliminar este cliente?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center; color: #6b7280; padding: 40px 0;">No hay clientes registrados en la base de datos. Haga clic en "+ Nuevo Cliente" para agregar uno.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
