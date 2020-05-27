<?php
	$database="taller2";
	$user='prueba';
	$password='prueba123';

try {
	
	$con=new PDO('mysql:host=localhost;dbname='.$database,$user,$password);

} catch (PDOException $e) {
	echo "Error".$e->getMessage();
}

	if(isset($_GET['CEDULA'])){
		$CEDULA=(int) $_GET['CEDULA'];

		$buscar_CEDULA=$con->prepare('SELECT * FROM persona WHERE CEDULA=:CEDULA LIMIT 1');
		$buscar_CEDULA->execute(array(
			':CEDULA'=>$CEDULA
		));
		$resultado=$buscar_CEDULA->fetch();

    $roles=$con->prepare('SELECT * FROM usuario WHERE CEDULA=:CEDULA LIMIT 1');
    $roles->execute(array(
      ':CEDULA'=>$CEDULA
    ));
    $rol=$roles->fetch();

	}else{
		header('Location: index.php');
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
 <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <h4 class="nav-link">Bienvenido Usuario<span class="sr-only"></span></h4>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="usu.php">Home<span class="sr-only"></span></a>
      </li>
  </ul>
    <span class="navbar-text">
     <a class="btn btn-primary" href="cerrar.php">Cerrar Sesion</a>
    </span>
  </div>
</nav>
<br>
  <div class="contenedor">
        <table table class="table table-sm table-dark">
<thead>
    <tr>
      <th scope="row"><h3>Usuario</h3></th>
      </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Nombre</th>
      <td> <?php echo $resultado['NOMBRE'];?> </td>
    </tr>
    <tr>
      <th scope="row">Apellido</th>
      <td><?php echo $resultado['APELLIDO']; ?></td>
    </tr>
    <tr>
      <th scope="row">Correo</th>
      <td><?php echo $resultado['CORREO']; ?></td>
    </tr>
    <tr>
      <th scope="row">Edad</th>
      <td><?php echo $resultado['EDAD']; ?></td>
    </tr>
    <tr>
      <th scope="row">Rol</th>
      <td><?php if($rol['ROL']==2){
        echo ("Usuario");
      }else {
        echo ("Administrador");
      }?></td>
    </tr>
     </table> 
     <a href="edit_user.php?CEDULA=<?php echo $fila['CEDULA']; ?>" class="btn btn-info">Editar</a>  
        </div>         
    </body>
</html>