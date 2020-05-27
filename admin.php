<?php

    session_start();

    if(!isset($_SESSION['rol'])){
        header('location: index.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('location: index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
   include_once dirname(__FILE__) . '/config.php';
            $str_datos = "";
             $con=mysqli_connect(HOST_DB,USUARIO_DB,USUARIO_PASS,NOMBRE_DB);
                if (mysqli_connect_errno()) {
                $str_datos.= "Error en la conexión: " . mysqli_connect_error();
            }
?>

<br>
  <div class="contenedor">
        <table table class="table table-sm table-dark">
<thead>
    <tr>
      <th scope="row"><h3>Usuarios</h3></th>
      </tr>
  </thead>
  <tbody>

          <?php
            $sql = "SELECT * from usuario" ;
            $resultado = mysqli_query($con,$sql);
            while($fila = mysqli_fetch_array($resultado)) {
         ?>
    <tr>
      <td><?php echo $fila['USUARIO']?></td>
      <td><?php if($fila['ROL']==2){
        echo ("Usuario");
      }else {
        echo ("Administrador");
      }?></td>
      <td><a href="details2.php?CEDULA=<?php echo $fila['CEDULA']; ?>" class="btn btn-info">Revisar perfil</a></td>
    </tr>   
    <?php
   }
    ?>
     </table>   
        </div>         
    </body>
</html>