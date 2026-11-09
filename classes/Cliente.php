<?php
/**
 * Clase Cliente que implementa el objeto Cliente y los métodos del CRUD
 */
class Cliente {
    private ?PDO $conn;
    private string $table_name = "clientes";

    // Propiedades del objeto Cliente
    public ?int $id = null;
    public ?string $nombre = null;
    public ?string $email = null;
    public ?string $telefono = null;
    public ?string $direccion = null;
    public ?string $fecha_registro = null;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    /**
     * CREATE: Crear un nuevo cliente
     */
    public function crear(): bool {
        $query = "INSERT INTO " . $this->table_name . " (nombre, email, telefono, direccion) VALUES (:nombre, :email, :telefono, :direccion)";
        
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre ?? ''));
        $this->email = htmlspecialchars(strip_tags($this->email ?? ''));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono ?? ''));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion ?? ''));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":direccion", $this->direccion);

        return $stmt->execute();
    }

    /**
     * READ: Obtener todos los clientes como un arreglo asociativo (robusto para SQLite y MySQL)
     */
    public function leerTodos(): array {
        $query = "SELECT id, nombre, email, telefono, direccion, fecha_registro FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * READ ONE: Obtener un solo cliente por ID
     */
    public function leerUno(): bool {
        $query = "SELECT id, nombre, email, telefono, direccion, fecha_registro FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->nombre = $row['nombre'];
            $this->email = $row['email'];
            $this->telefono = $row['telefono'];
            $this->direccion = $row['direccion'];
            $this->fecha_registro = $row['fecha_registro'];
            return true;
        }
        return false;
    }

    /**
     * UPDATE: Actualizar un cliente existente
     */
    public function actualizar(): bool {
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre = :nombre, email = :email, telefono = :telefono, direccion = :direccion 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre ?? ''));
        $this->email = htmlspecialchars(strip_tags($this->email ?? ''));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono ?? ''));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion ?? ''));
        $this->id = (int)($this->id ?? 0);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":telefono", $this->telefono);
        $stmt->bindParam(":direccion", $this->direccion);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /**
     * DELETE: Eliminar un cliente por ID
     */
    public function eliminar(): bool {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $this->id = (int)($this->id ?? 0);
        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
?>
