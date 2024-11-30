<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Inventario</h1>

        <div class="section">
            <h2>Productos</h2>
           <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

if ($result->num_rows > 0): ?>
    <div class="section">
        <h2>Productos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="productos">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                        <td>$<?php echo number_format($row['precio'], 2); ?></td>
                        <td>
                            <a href="editar_producto.php?id=<?php echo $row['id']; ?>" class="btn">Editar</a>
                            <a href="eliminar_producto.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="section">
        <h2>Productos</h2>
        <p>No hay productos en la base de datos.</p>
    </div>
<?php endif;

$conn->close();
?>

        </div>

        <div class="section">
            <h2>Agregar Producto</h2>
            <form id="formAgregarProducto" action="add_product.php" method="POST">
                <input type="text" name="nombre" placeholder="Nombre del producto" required>
                <input type="number" name="cantidad" placeholder="Cantidad" required>
                <input type="number" name="precio" placeholder="Precio" required>
                <button type="submit" class="btn">Agregar</button>
            </form>
        </div>

        <div class="section">
           
    <div class="container">
        <h1>Bienvenido a la Tienda</h1>
        <a href="tienda.php" class="btn btn-large">Ir a la Tienda</a>
    </div>
    </div>



    <script src="script.js"></script>
    
</body>


</html>
