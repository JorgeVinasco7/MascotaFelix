
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipo_usuario WHERE identificacion = '".$_SESSION['usuario']."' AND usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
$usua = mysqli_fetch_assoc($usuarios);
?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {
    $tp=$_POST ['Tipo_usu'];
    $sqladd="SELECT *FROM tipo_usuario WHERE tipo_usuario='$tp'";
    $query = mysqli_query($mysqli,$sqladd);
    $fila = mysqli_fetch_assoc($query);
    if($fila){
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="AgregarUsuario.php"</script>';
    }
    else 
       if($_POST['Tipo_usu']==""){
        echo '<script>alert ("Existen campos vacios");</script>';
        echo '<script>window.location="AgregarUsuario.php"</script>';
    }
    else{
        $tp=$_POST ['Tipo_usu'];
        $sqladd=" INSERT INTO tipo_usuario(tipo_usuario) VALUES ('$tp') ";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert ("Registro exitoso");</script>';
        echo '<script>window.location="AgregarUsuario.php"</script>';
    }
}

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
    <title>taller</title>
</head>
    <body onload="frmadd.Tipo_usu.focus()">
        <section class="title">
            <h1>Formulario de creacion tipo usuario:<?php echo $usua['tipo_usuario']?></h1>
        </section>
        <table class="centrar">
           <form method="POST" name="frmadd" autocomplete="off">
             <tr>
                <td colspan="2"> tipos de usuarios </td>
             </tr>
             <tr>
                <td>Identificador:</td>
                <td><input type="text" readonly></td>
             </tr>

             <tr>
                <td>Tipo Usuario:</td>
                <td><input type="text" name="Tipo_usu" placeholder="Ingrese tipo usuario" style="text-transform:uppercase;"></td>
             </tr>

             <tr>
                <td colspan="2">&nbsp; </td>
             </tr>

             <tr>
                <td colspan="2"><input type="submit" name="btnadd" value="Guardar"></td>
                <input type="hidden" name="btnguardar" value="frmadd">
             </tr>
           </form>
        </table>        
        
    </body>
</html>