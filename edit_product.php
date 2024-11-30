<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    $updateSql = "UPDATE productos SET nombre='$nombre', cantidad=$cantidad, precio=$precio WHERE id=$id";
    if ($conn->query($updateSql) === TRUE) {
        header("Location: view_products.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Editar Producto</h1>
        <div class="section">
            <form action="" method="POST">
                <input type="text" name="nombre" value="<?php echo $product['nombre']; ?>" required>
                <input type="number" name="cantidad" value="<?php echo $product['cantidad']; ?>" required>
                <input type="number" name="precio" value="<?php echo $product['precio']; ?>" required>
                <button type="submit" class="btn">Guardar Cambios</button>
            </form>
        </div>
        <a href="view_products.php" class="btn">Cancelar</a>
    </div>
</body>
</html>
