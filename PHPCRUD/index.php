<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Clientes</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>Lista de Clientes</h2>
    <a class="btn btn-primary" href="/PHPCRUD/crear.php" role="button">Nuevo Cliente</a>
    <br>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>NOMBRE</th>
          <th>EMAIL</th>
          <th>TELEFONO</th>
          <th>DIRECCION</th>
          <th>FECHA DE CREACION</th>
          <th>ACCIONES</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mitienda";

        // CREAR CONEXION
        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // LEER
        $sql = "SELECT * FROM CLIENTE";
        $result = $connection->query($sql);

        if (!$result) {
            die("Consulta inválida: " . $connection->error);
        }

        // LEER CONTENIDO DE CADA FILA
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                <td>{$row['ID']}</td>
                <td>{$row['NOMBRE']}</td>
                <td>{$row['EMAIL']}</td>
                <td>{$row['TELEFONO']}</td>
                <td>{$row['DIRECCION']}</td>
                <td>{$row['FECHACREACION']}</td>
                <td>
                  <a class='btn btn-primary btn-sm' href='/PHPCRUD/editar.php?ID={$row['ID']}'>Editar</a>
                  <a class='btn btn-danger btn-sm' href='/PHPCRUD/eliminar.php?ID={$row['ID']}' >Eliminar</a>
                </td>
                </tr>
            ";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>