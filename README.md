# CRUD de Clientes con POO en PHP

**Asignatura:** Aplicaciones Web  
**Carrera:** Ingeniería de Software (6to Semestre)  
**Semana:** Semana 2 - Tarea 1  
**Fecha:** 08 de Noviembre del 2026  

---

## Descripción del Proyecto

Esta aplicación web implementa un sistema CRUD completo (**Create, Read, Update, Delete**) aplicando **Programación Orientada a Objetos (POO)** en **PHP**, cumpliendo con los estándares modernos de desarrollo web y buenas prácticas de ingeniería de software.

### Características Principales:
1. **Modelo de Clases POO:** Clase `Cliente` encapsulada con propiedades fuertemente tipadas y métodos específicos para cada operación CRUD.
2. **Conexión Segura con PDO:** Uso de PHP Data Objects (PDO) con sentencias preparadas (`prepared statements`) para prevenir inyecciones SQL.
3. **Persistencia Autónoma:** Base de datos SQLite integrada por defecto (sin requerir configuraciones complejas de servidores de bases de datos externos) con creación automática de tablas.
4. **Interfaz de Usuario (HTML5 & CSS3):** Diseño moderno, responsivo y limpio con tarjetas, tablas estilizadas, alertas y formularios intuitivos.

---

## Estructura de Archivos

```text
CRUD_Cliente/
│
├── assets/
│   └── css/
│       └── style.css       # Estilos modernos y responsivos
│
├── classes/
│   └── Cliente.php         # Objeto Cliente y métodos CRUD (POO)
│
├── config/
│   └── database.php        # Conexión PDO a la base de datos
│
├── database/
│   └── clientes.db         # Archivo de base de datos SQLite (auto-generado)
│
├── create.php              # Formulario y lógica de creación
├── edit.php                # Formulario y lógica de actualización
├── delete.php              # Lógica de eliminación
├── index.php               # Vista principal (Listado y tabla CRUD)
└── README.md               # Documentación de la tarea
```

---

## ¿Cómo Ejecutar la Aplicación?

1. **Requisitos:** Tener instalado [PHP](https://www.php.net/) (versión 8.0 o superior recomendada).
2. **Iniciar el servidor local de PHP:**
   Abra su terminal o consola en la carpeta del proyecto y ejecute:
   ```bash
   php -S localhost:8000
   ```
3. **Acceder en el navegador:**
   Abra su navegador web e ingrese a:
   ```text
   http://localhost:8000
   ```
