
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipo_usuario WHERE identificacion = '".$_SESSION['usuario']."' AND usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
$usua = mysqli_fetch_assoc($usuarios);
?>
<span id="button-menu" class="fa fa-bars"></span>
		<span class="usuario"> <?php echo $usua['tipo_usuario']?></span>
		<span class="usuario"> 
			<a href="../../controller/salir.php"><img src="../../controller/image/salir.png" width=30></a>
			<?php echo $usua['nombre']?>
		</span>
<?php 
/* agregamos un mensaje en el codigo para actualizar en git y asi poderlo manejar este codigo va subido a la nube del GibHub*/
if(isset($_POST['btncerrar']))
{
	session_destroy();

   
    header('location: ../../index.html');
}
	
?>

</div>

</div>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Administrador</title>
</head>
    <body>
        <section class="title">
            <h1><?php echo $usua['tipo_usuario']?></h1>
        </section>
    
        <nav class="navegacion">
           
            <ul class="menu wrapper" >
    
                <li class="first-item">
                    <a href="AgregarUsuario.php">
                        <img src="img/analisis.png" alt="" class="imagen">
                        <span class="text-item">Crear tipo de usuario</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="Usuarios.php">
                        <img src="img/ejecucion.png" alt="" class="imagen">
                        <span class="text-item">Crear Usuarios</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="Mascota.php">
                        <img src="img/implementar.jpg" alt="" class="imagen">
                        <span class="text-item">Mascota</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="img/planear.png" alt="" class="imagen">
                        <span class="text-item">OPCION 4</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 5</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li class="first-item">
                    <a href="#">
                        <img src="img/analisis.png" alt="" class="imagen">
                        <span class="text-item">OPCION 6</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 7</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 8</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 9</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 10</span>
                        <span class="down-item"></span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <img src="" alt="" class="imagen">
                        <span class="text-item">OPCION 11</span>
                        <span class="down-item"></span>
                    </a>
                </li>
                
            </ul>
            
        </nav>
    </body>
</html>