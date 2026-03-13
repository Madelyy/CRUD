<?php
    $nombre = "";
    $email = "";
    $telefono = "";
    $direccion = "";
    $errorMessage = "";
    $successMessage = "";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mitienda";
    $connection = new mysqli($servername, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " .$connection->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST["NOMBRE"];
        $email = $_POST["EMAIL"];
        $telefono = $_POST["TELEFONO"];
        $direccion = $_POST["DIRECCION"];

        if (empty($nombre) || empty($email) || empty($telefono) || empty($direccion)) {
            $errorMessage = "Todos los campos son requeridos";
        } else {
            $sql = "INSERT INTO CLIENTE (NOMBRE, EMAIL, TELEFONO, DIRECCION) VALUES ('$nombre', '$email', '$telefono', '$direccion')";
            if ($connection->query($sql) === TRUE) {
                $successMessage = "Cliente agregado correctamente";
                header("Location: /PHPCRUD/index.php");
                exit();
            } else {
                $errorMessage = "Error al agregar el cliente: " . $connection->error;
            }
        }
    }
    $connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuevo Cliente</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Nuevo Cliente</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="NOMBRE" value="<?php echo htmlspecialchars($nombre); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="EMAIL" value="<?php echo htmlspecialchars($email); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefono</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="TELEFONO" value="<?php echo htmlspecialchars($telefono); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Direccion</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="DIRECCION" value="<?php echo htmlspecialchars($direccion); ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>