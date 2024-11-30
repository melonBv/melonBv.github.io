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

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = [
        'id' => $_POST['id'],
        'nombre' => $_POST['nombre'],
        'precio' => $_POST['precio'],
        'cantidad' => $_POST['cantidad']
    ];

    $indice = array_search($producto['id'], array_column($_SESSION['carrito'], 'id'));
    if ($indice !== false) {
        $_SESSION['carrito'][$indice]['cantidad'] += $producto['cantidad'];
    } else {
        $_SESSION['carrito'][] = $producto;
    }
}

if (isset($_POST['comprar'])) {
    foreach ($_SESSION['carrito'] as $producto) {
        $id = $producto['id'];
        $cantidad = $producto['cantidad'];
        $sqlUpdate = "UPDATE productos SET cantidad = cantidad - $cantidad WHERE id = $id";
        $conn->query($sqlUpdate);
    }
    $_SESSION['carrito'] = []; 
    echo "<script>alert('Compra realizada con éxito'); window.location.href = 'index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
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
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 20px;
            text-transform: uppercase;
            color: #111;
        }

        .carrito-productos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .producto-carrito {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            width: 280px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .producto-carrito h3 {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .producto-carrito p {
            margin: 5px 0;
            color: #666;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #111;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #e0e0e0;
            color: #111;
        }

        .total {
            text-align: center;
            font-size: 20px;
            margin: 20px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Carrito de Compras</h1>
        <?php if (!empty($_SESSION['carrito'])): ?>
            <ul>
                <?php foreach ($_SESSION['carrito'] as $producto): ?>
                    <li>
                        <?php echo htmlspecialchars($producto['nombre']); ?> - 
                        $<?php echo number_format($producto['precio'], 2); ?> x 
                        <?php echo $producto['cantidad']; ?> = 
                        $<?php echo number_format($producto['precio'] * $producto['cantidad'], 2); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <form method="POST">
                <button type="submit" name="comprar" class="btn">Finalizar Compra</button>
            </form>
        <?php else: ?>
            <p>El carrito está vacío.</p>
        <?php endif; ?>
        <a href="tienda.php" class="btn">Seguir Comprando</a>
    </div>
     <center><a href="index.php" class="btn">Regresar al inventario</a></center>
</body>
</html>

<?php
$conn->close();
?>
