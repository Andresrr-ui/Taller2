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
	}else{
		header('Location: usu.php');
	}

	if(isset($_POST['guardar'])){
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$correo=$_POST['correo'];
		$edad=$_POST['edad'];

		if(!empty($nombre) && !empty($apellido) && !empty($correo) && !empty($edad) ){
			if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
				echo "<script> alert('Correo no valido');</script>";
			}else{
				$consulta_update=$con->prepare(' UPDATE persona SET  
					nombre=:nombre,
					apellido=:apellido,
					correo=:correo,
					edad=:edad
					WHERE CEDULA=:CEDULA;'
				);
				$consulta_update->execute(array(
					':nombre' =>$nombre,
					':apellido' =>$apellido,
					':correo' =>$correo,
					':edad' =>$edad,
					':CEDULA' =>$CEDULA
				));
				header('Location: index.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Actualizar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="contenedor">
		<form action="" method="post">
			<div class="form-group">
				<label>Nombre</label>
				<input type="text" name="nombre" value="<?php if($resultado) echo $resultado['NOMBRE']; ?>" class="input__text">
				<label>Apellido</label>
				<input type="text" name="apellido" value="<?php if($resultado) echo $resultado['APELLIDO']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<label>Correo</label>
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['CORREO']; ?>" class="input__text">
				<label>Edad</label>
				<input type="text" name="edad" value="<?php if($resultado) echo $resultado['EDAD']; ?>" class="input__text">
			</div>
			<div class="btn-group">
				<a href="usu.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn-primary">
			</div>
		</form>
	</div>
</body>
</html>