<?php
/**
 * Controlador - Eliminar Cliente
 */
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/classes/Cliente.php';

$database = new Database();
$db = $database->getConnection();

$cliente = new Cliente($db);

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $cliente->id = $id;
    if ($cliente->eliminar()) {
        header("Location: index.php?mensaje=eliminado");
        exit();
    } else {
        header("Location: index.php?error=ErrorAlEliminar");
        exit();
    }
} else {
    header("Location: index.php?error=IdInvalido");
    exit();
}
?>
