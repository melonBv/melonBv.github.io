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

$sql = "DELETE FROM productos WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: view_products.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
