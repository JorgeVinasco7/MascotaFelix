
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipo_usuario WHERE identificacion = '".$_SESSION['usuario']."' AND usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
$usua = mysqli_fetch_assoc($usuarios);
?>
<?php
//consulta nombre
$sql1 = "SELECT * FROM mascota WHERE id_tipo_mascota";
$Nom_Mas = mysqli_query($mysqli, $sql1) or die(mysqli_error());
$nombre1 = mysqli_fetch_assoc($Nom_Mas);

//consulta medicamento
$sql2 = "SELECT * FROM medicamentos WHERE id_medicamentos";
$medicamento = mysqli_query($mysqli, $sql2) or die(mysqli_error());
$medi1 = mysqli_fetch_assoc($medicamento);
?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {

    if($_POST['NomMascota']=="" || $_POST['Medi']==""){
        echo '<script>alert ("Existen campos vacios");</script>';
        echo '<script>window.location="index.php"</script>';
    }
    else{
        $Nom_Mascota=$_POST ['NomMascota'];
        $medicamento=$_POST ['Medi'];
        $sqladd="INSERT INTO receta(id_visita,id_medicamento) VALUES ('$Nom_Mascota', '$medicamento')";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert ("Registro exitoso");</script>';
        echo '<script>window.location="index.php"</script>';
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
            <h1>Formulario Recetas.</h1>
        </section>
        <table class="centrar">
           <form method="POST" name="frmadd" autocomplete="off">
             <tr>
                <td colspan="2">Recetas para Mascota</td>
             </tr>
             <tr>
                <td><br>Nombre Mascota:</td>
                <td>
                  <br>
                  <select name="NomMascota">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($nombre1['id_tipo_usuario'])?>"><?php echo($nombre1['nombre'])?></option>
                      <?php
                     }while($nombre1=mysqli_fetch_assoc($Nom_Mas));
                      ?>
                  </select> 
                </td>
             </tr>

             <tr>
                <td>Medicamentos:</td>
                <td>
                  <select name="Medi">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($medi1['id_medicamentos'])?>"><?php echo($medi1['medicamento'])?></option>
                      <?php
                     }while($medi1=mysqli_fetch_assoc($medicamento));
                      ?>
                  </select> 
                </td>
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