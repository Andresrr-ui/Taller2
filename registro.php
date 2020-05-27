<?php
include_once 'conect.php';
if(isset($_POST['guardar'])){
 $usuario=$_POST["usuario"];
 $cedula=$_POST['cedula'];
 $password=$_POST["password"];
 $rol=2;

$contra_cf= password_hash($password, PASSWORD_DEFAULT);

$revision=sprintf("SELECT * FROM persona WHERE CEDULA=%s",
    $_POST['cedula'],'int');


$consulta_cedula=mysqli_query($con,$revision);
$datos_cedula=mysqli_fetch_assoc($consulta_cedula);
$comprobadorced=mysqli_num_rows($consulta_cedula);


$revision=sprintf("SELECT * FROM usuario WHERE USUARIO=%s",
    $_POST['usuario'],'text');

$consulta_usuario=mysqli_query($con,$revision);
$datos_usuario=mysqli_fetch_assoc($consulta_usuario);
$comprobadorusr=mysqli_num_rows($consulta_usuario);

echo $comprobadorced;
if ($comprobadorced==0){
  if ($comprobadorusr==0){
  $cons=$con->prepare('INSERT INTO usuario (usuario,cedula,password,rol) VALUES(:usuario,:cedula,:contra_cf,:rol)');
        $cons->execute(array(
          ':usuario' =>$usuario,
          ':cedula' =>$cedula,
          ':contra_cf' =>$contra_cf,
          ':rol' =>$rol
        ));
        header('Location: ../index.php');
//comprobador del if username
} else {
  echo "<script> alert('El nombre de usuario ya esta registrado');</script>";
} 
//comprobador del if cedula
} else {
  echo "<script> alert('La cedula no esta en registros, consulte al admin');</script>";
}
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
<form action="" method="POST">
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
