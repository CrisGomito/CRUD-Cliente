<?php
/**
 * Clase Database para la conexión PDO a la base de datos (SQLite / MySQL)
 */
class Database {
    private string $dbFile;
    private ?PDO $conn = null;

    public function __construct() {
        $dbDir = __DIR__ . '/../database';
        if (!file_exists($dbDir)) {
            mkdir($dbDir, 0777, true);
        }
        $this->dbFile = $dbDir . '/clientes.db';
    }

    public function getConnection(): ?PDO {
        $this->conn = null;
        try {
            $dsn = "sqlite:" . $this->dbFile;
            $this->conn = new PDO($dsn);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            // Asegurar que la tabla existe
            $this->createTable();
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }

    private function createTable(): void {
        $query = "CREATE TABLE IF NOT EXISTS clientes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nombre TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            telefono TEXT NOT NULL,
            direccion TEXT NOT NULL,
            fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $this->conn->exec($query);
    }
}
?>
