
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$productos = json_decode($_POST['productos'], true);


foreach ($productos as $producto) {
    $producto_id = $producto['id'];
    $cantidad = $producto['cantidad'];
    $precio = $producto['precio'];
    $total = $cantidad * $precio;

  
    $sqlVenta = "INSERT INTO ventas (producto_id, cantidad, total) VALUES ('$producto_id', '$cantidad', '$total')";
    $conn->query($sqlVenta);
}


foreach ($productos as $producto) {
    $producto_id = $producto['id'];
    $cantidad = $producto['cantidad'];

 
    $sqlProducto = "SELECT cantidad FROM productos WHERE id = '$producto_id'";
    $result = $conn->query($sqlProducto);
    $row = $result->fetch_assoc();
    $cantidadActual = $row['cantidad'];

  
    $nuevaCantidad = $cantidadActual - $cantidad;
    $sqlActualizar = "UPDATE productos SET cantidad = '$nuevaCantidad' WHERE id = '$producto_id'";
    $conn->query($sqlActualizar);
}

$conn->close();


header("Location: index.php");
exit;
?>
