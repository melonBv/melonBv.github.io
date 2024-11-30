<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sqlProductos = "SELECT * FROM productos";
$resultProductos = $conn->query($sqlProductos);


$sqlVentas = "SELECT * FROM ventas";
$resultVentas = $conn->query($sqlVentas);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heelz Shop</title>
    <link rel="stylesheet" href="tienda.css">
    <style>

    body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f1f1f1; 
    color: #333; 
}


.container {
    width: 85%;
    margin: 0 auto;
    padding: 40px;
    background-color: #fff; 
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1)
    border-radius: 10px; 
}


h1 {
    text-align: center;
    font-size: 36px;
    font-weight: bold;
    color: #111; 
    margin-bottom: 40px;
    text-transform: uppercase; 
}


.section {
    margin-bottom: 30px;
}


h2 {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
    text-transform: uppercase; 
    letter-spacing: 1px;
}


.productos-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center;
}

.producto-card {
    width: 220px;
    background-color: #fff;
    border: 1px solid #ddd; 
    padding: 20px;
    text-align: center;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); 
    border-radius: 10px;
    transition: transform 0.3s ease-in-out;
}

.producto-card:hover {
    transform: scale(1.05);
}

.producto-card h3 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #222;
    text-transform: capitalize;
}

.producto-card p {
    font-size: 16px;
    margin: 5px 0;
    color: #666; 
}


.btn {
    padding: 10px 20px;
    background-color: #111;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase; 
    letter-spacing: 1px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #e0e0e0;
    color: #111;
}

/* Diseño responsivo */
@media (max-width: 768px) {
    .producto-card {
        width: 45%; 
    }
}

@media (max-width: 480px) {
    .producto-card {
        width: 90%;
    }
}
</style>
</head>
<?php
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sqlProductos = "SELECT * FROM productos";
$resultProductos = $conn->query($sqlProductos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heelz Shop</title>
    <link rel="stylesheet" href="tienda.css">
</head>
<body>
    <div class="container">
        <h1>Heelz Shop</h1>
        <a href="carrito.php" class="btn">Ir al Carrito</a>
        <div class="productos-container">
            <?php while ($row = $resultProductos->fetch_assoc()): ?>
                <div class="producto-card">
                    <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
                    <p>Precio: $<?php echo number_format($row['precio'], 2); ?></p>
                    <p>Stock: <?php echo $row['cantidad']; ?></p>
                    <form action="carrito.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($row['nombre']); ?>">
                        <input type="hidden" name="precio" value="<?php echo $row['precio']; ?>">
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="btn">Agregar al carrito</button>
                    </form>

                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <center> <a href="index.php" class="btn">Regresar al inventario</a></center>
</body>
</html>

<?php
$conn->close();
?>
