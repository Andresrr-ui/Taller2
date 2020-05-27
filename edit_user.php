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

		$buscar_CEDULA=$con->prepare('SELECT * FROM usuario WHERE CEDULA=:CEDULA LIMIT 1');
		$buscar_CEDULA->execute(array(
			':CEDULA'=>$CEDULA
		));
		$resultado=$buscar_CEDULA->fetch();
	}else{
		header('Location: usu.php');
	}

	if(isset($_POST['guardar'])){
		$ROL=$_POST['ROL'];

		if ($ROL=="administrador"){
			$ROL=1;
		}

		if ($ROL=="usuario"){
			$ROL=2;
		}

		if(!empty($ROL)){
				$consulta_update=$con->prepare(' UPDATE usuario SET  
					ROL=:ROL
					WHERE CEDULA=:CEDULA;'
				);
				$consulta_update->execute(array(
					':ROL' =>$ROL
				));
				header('Location: admin.php');
			}
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
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
				<label>Usuario</label>
				<p><?php echo $resultado['USUARIO'];?></p>
				<label>Rol</label>
				<input type="radio" name="rol" value="administrador">
				<input type="radio" name="rol" value="usuario">
			<div class="btn-group">
				<a href="admin.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn-primary">
			</div>
		</form>
	</div>
</body>
</html>