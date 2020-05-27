 <?php
            $servidor = "127.0.0.1";
            $nombreusuario = "prueba";
            $password = "prueba123";
            $db = "Taller2";

            $conexion = new mysqli($servidor, $nombreusuario, $password, $db);
        
            if($conexion->connect_error){
                die("Conexión fallida: " . $conexion->connect_error);
            }

            if(isset($_POST['usuario'])&&isset($_POST['cedula'])&&isset($_POST['contraseña'])){
                $usuario = $_POST['usuario'];
                $cedula = $_POST['cedula'];
                $password = $_POST['password'];
                $rol =2;
                $contra_cif= password_hash($password, PASSWORD_DEFAULT);


                $sql = "INSERT INTO usuario (usuario, cedula, password, rol) VALUES('$usuario','$cedula','$contra_cif','$rol')";
                
                if($conexion->query($sql) === true){
                    echo "<script> alert('usuario registrado');</script>";
                   header('location: index.php');
                }else{
                    die("Error al insertar datos: " . $conexion->error);
                }
                $conexion->close();
            }

        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Inicio de sesion</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
<header class="card-header">
	<h3 class="card-title mt-2">Registro</h3>
</header>
<article class="card-body">
<form action="index.php" method="POST">
	<div class="form-row">
		<div class="col form-group">
			<label>Nombre de Usuario</label>   
		  	<input type="text" class="form-control" name="usuario">
		</div> 
		<div class="col form-group">
			<label>Cedula</label>
		  	<input type="text"class="form-control" name="cedula">
		</div> 
	</div> 
	<div class="form-group">
		<label>Contraseña</label>
	    <input class="form-control" type="password" name="password">
	</div>
    <div class="form-group">
       <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
    </div>                                           
</form>
</article>
<br>
</div>
</div>
</div>
</body>
</html>
