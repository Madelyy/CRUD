<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Cliente</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Actualizar Cliente</h2>
        <?php
        $errorMessage = '';
        $successMessage = '';

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mitienda";

        $connection = new mysqli($servername, username: $username, $password, $database);

        if (isset($_GET['ID'])) {
            $id = $_GET['ID'];
            $sql = "SELECT * FROM CLIENTE WHERE ID = $id";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nombre = $row['NOMBRE'];
                $email = $row['EMAIL'];
                $telefono = $row['TELEFONO'];
                $direccion = $row['DIRECCION'];
            } else {
                $errorMessage = "Cliente no encontrado.";
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['NOMBRE'];
            $email = $_POST['EMAIL'];
            $telefono = $_POST['TELEFONO'];
            $direccion = $_POST['DIRECCION'];

            if (empty($nombre) || empty($email) || empty($telefono) || empty($direccion)) {
                $errorMessage = "Todos los campos son obligatorios.";
            } else {
                $sql = "UPDATE CLIENTE SET NOMBRE='$nombre', EMAIL='$email', TELEFONO='$telefono', DIRECCION='$direccion' WHERE ID=$id";
                if ($connection->query($sql) === TRUE) {
                    $successMessage = "Cliente actualizado correctamente.";
                    header("Location: /PHPCRUD/index.php");
                    exit();
                } else {
                    $errorMessage = "Error al actualizar el cliente: " . $connection->error;
                }
            }
        }

        $connection->close();
        ?>
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
            <input type="text" class="form-control" name="NOMBRE" value="<?php echo isset($nombre) ? $nombre : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="EMAIL" value="<?php echo isset($email) ? $email : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Telefono</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="TELEFONO" value="<?php echo isset($telefono) ? $telefono : ''; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Direccion</label>
            <div class="col-sm-6">
            <input type="text" class="form-control" name="DIRECCION" value="<?php echo isset($direccion) ? $direccion : ''; ?>">
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