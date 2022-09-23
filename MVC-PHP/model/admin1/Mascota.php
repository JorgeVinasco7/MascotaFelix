
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipo_usuario WHERE identificacion = '".$_SESSION['usuario']."' AND usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
$usua = mysqli_fetch_assoc($usuarios);
?>
<?php
$sql1 = "SELECT * FROM tipo_mascota WHERE  id_tipo_mascota <4";
$tipo_masco = mysqli_query($mysqli, $sql1) or die(mysqli_error());
$masco1 = mysqli_fetch_assoc($tipo_masco);
?>
<?php
$sql2 = "SELECT * FROM usuario WHERE  identificacion";
$docu_iden = mysqli_query($mysqli, $sql2) or die(mysqli_error());
$masco2 = mysqli_fetch_assoc($docu_iden);
?>
<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {
        $Id_Dueño=$_POST ['Iden'];
        $sqladd="SELECT *FROM usuario WHERE identificacion='$Id_Dueño'";
        $query = mysqli_query($mysqli,$sqladd);
        $fila = mysqli_fetch_assoc($query);
    if($fila){
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="Mascota.php"</script>';
    }
    else
       if($_POST['Iden']=="" || $_POST['tipo_mascota']=="" || $_POST['NomM']=="" || $_POST['razaM']=="" || $_POST['ColM']==""){
        echo '<script>alert ("Existen campos vacios");</script>';
        echo '<script>window.location="Mascota.php"</script>';
    }
    else{
        $Id_Dueño=$_POST ['Iden'];
        $Tipo_Mas=$_POST ['tipo_mascota'];
        $Nmascota=$_POST ['NomM'];
        $Rmascota=$_POST ['razaM'];
        $Cmascota=$_POST ['ColM'];
        $sqladd="INSERT INTO mascota(id_dueño,id_tipo_mascota,nombre,raza,color) VALUES('$Id_Dueño','$Tipo_Mas','$Nmascota','$Rmascota','$Cmascota')";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert ("Registro exitoso");</script>';
        echo '<script>window.location="Mascota.php"</script>';
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
    <title>Administrador</title>
</head>
    <body onload="frmadd.Tipo_usu.focus()">
        <section class="title">
            <h1>Formulario para Mascotas</h1>
        </section>
        <table class="centrar">
           <form method="POST" name="frmadd" autocomplete="off">
             <tr>
                <td colspan="2">Tipos de Mascota</td>
             </tr>
             <tr>
                <td><br>Nombre:</td>
                <td><br><input type="text" name="NomM" placeholder="Nombre de la mascota" style="text-transform:uppercase;"></td>
             </tr>
             <tr>
                <td>Raza:</td>
                <td><input type="text" name="razaM" placeholder="Raza Mascota" style="text-transform:uppercase;"></td>
             </tr>
             <tr>
                <td>Color:</td>
                <td><input type="text" name="ColM" placeholder="Color de la mascota" style="text-transform:uppercase;"></td>
             </tr>
             <tr>
                <td>Documento:</td>
                <td>
                  <select name="Iden">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($masco2['id_usuario'])?>"><?php echo($masco2['identificacion'])?></option>
                      <?php
                     }while($masco2=mysqli_fetch_assoc($docu_iden));
                      ?>
                  </select> 
                </td>
             </tr>
             <tr>
                <td>Tipo Mascota:</td>
                <td>
                  <select name="tipo_mascota">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($masco1['id_tipo_mascota'])?>"><?php echo($masco1['tipo_mascota'])?></option>
                      <?php
                     }while($masco1=mysqli_fetch_assoc($tipo_masco));
                      ?>
                  </select> 
                </td>
             </tr>
             <tr>
                <td colspan="2"><br><input type="submit" name="btnadd" value="Guardar"></td>
                <input type="hidden" name="btnguardar" value="frmadd">
             </tr>
           </form>
        </table>               
    </body>
</html>