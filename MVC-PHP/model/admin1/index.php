
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipo_usuario WHERE identificacion = '".$_SESSION['usuario']."' AND usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
$usua = mysqli_fetch_assoc($usuarios);
?>
<span id="button-menu" class="fa fa-bars"></span>
		<br><span class="usuario"><?php echo $usua['tipo_usuario']?></span>
		<span class="usuario"> 
        <?php
        $signo=":"; 
        echo $signo;
        echo $usua['nombre'];
        echo $usua['apellido'];  
        ?>
        <a href="../../controller/salir.php">Cerrar Sesion:<img src="../../controller/image/salir.png" width=50></a>
		</span>
<?php 
/* agregamos un mensaje en el codigo */
if(isset($_POST['btncerrar']))
{
	session_destroy();
    header('location: ../../index.html');
}
	
?>

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
                        <span class="text-item">CREAR TIPO DE USUARIOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="Usuarios.php">
                        <img src="img/ejecucion.png" alt="" class="imagen">
                        <span class="text-item">CREAR USUARIO</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="Mascota.php">
                        <img src="img/implementar.jpg" alt="" class="imagen">
                        <span class="text-item">MASCOTAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="Visitas.php">
                        <img src="img/planear.png" alt="" class="imagen">
                        <span class="text-item">VISITAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li>
                    <a href="Afiliacion.php">
                        <img src="img/planear.png" alt="" class="imagen">
                        <span class="text-item">AFILIACION</span>
                        <span class="down-item"></span>
                    </a>
                </li>
    
                <li class="first-item">
                    <a href="Medicamentos.php">
                        <img src="img/analisis.png" alt="" class="imagen">
                        <span class="text-item">MEDICAMENTOS</span>
                        <span class="down-item"></span>
                    </a>
                </li>
                <li>
                    <a href="Recetas.php">
                        <img src="img/ejecucion.png" alt="" class="imagen">
                        <span class="text-item">RECETAS</span>
                        <span class="down-item"></span>
                    </a>
                </li>            
            </ul> 
        </nav>
    </body>
</html>