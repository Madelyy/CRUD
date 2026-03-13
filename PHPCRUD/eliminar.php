<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mitienda";

    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
    }

    if (isset($_GET['ID'])) {
    $id = $_GET['ID'];
    $sql = "DELETE FROM CLIENTE WHERE ID = $id";

    if ($connection->query($sql) === TRUE) {
        echo "Cliente eliminado correctamente";
    } else {
        echo "Error al eliminar el cliente: " . $connection->error;
    }
    }
    $connection->close();
    header("Location: /PHPCRUD/index.php");
    exit();
?>