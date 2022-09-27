
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM usuario, tipo_usuario WHERE identificacion = '".$_SESSION['usuario']."' AND usuario.id_tipo_usuario = tipo_usuario.id_tipo_usuario";
$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
$usua = mysqli_fetch_assoc($usuarios);
?>
<?php
//consulta para los tipos de usuarios
$sql0 = "SELECT * FROM usuario WHERE identificacion";
$docu1 = mysqli_query($mysqli, $sql0) or die(mysqli_error());
$Docu1 = mysqli_fetch_assoc($docu1);

$sql1 = "SELECT * FROM mascota WHERE id_tipo_mascota";
$Nom_mas = mysqli_query($mysqli, $sql1) or die(mysqli_error());
$Nombre = mysqli_fetch_assoc($Nom_mas);

$sql2 = "SELECT * FROM estado WHERE id_estado <5";
$Esta_Masco = mysqli_query($mysqli, $sql2) or die(mysqli_error());
$EstadoM = mysqli_fetch_assoc($Esta_Masco);
?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {
    $doc=$_POST ['Docu'];
    $sqladd="SELECT *FROM usuario WHERE identificacion='$doc'";
    $query = mysqli_query($mysqli,$sqladd);
    $fila = mysqli_fetch_assoc($query);

    if($fila){
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="Visitas.php"</script>';
    }
    else
       if($_POST['Docu']=="" || $_POST['Nom']=="" || $_POST['EstaM']=="" || $_POST['Tem']=="" || $_POST['Peso']=="" || $_POST['FreR']=="" || $_POST['FreC']=="" || $_POST['Docu']=="" || $_POST['EstaAnimo']=="" || $_POST['Reco']=="" || $_POST['CostoVisita']=="" || $_POST['fecha_']==""){
        echo '<script>alert ("Existen campos vacios");</script>';
        echo '<script>window.location="Visitas.php"</script>';
    }
    else{
        $doc=$_POST ['Docu'];
        $Nombre=$_POST ['Nom'];
        $EstadoMas=$_POST ['EstaM'];
        $fecha_actual=$_POST ['fecha_'];
        $Temp=$_POST ['Tem'];
        $peso=$_POST ['Peso'];
        $FrecR=$_POST ['FreR'];
        $FrecC=$_POST ['FreC'];
        $Esta_Ani=$_POST ['EstaAnimo'];
        $reco=$_POST ['Reco'];
        $Costo_Visita=$_POST ['CostoVisita'];

        $sqladd="INSERT INTO visita(id_mascota,id_dueño,id_estado,fecha_visita,temperatura,peso,freq_respi,freq_cardi,estado_animo,recomendaciones,costo_visita) VALUES ('$doc','$Nombre','$EstadoMas','$fecha_actual','$Temp','$peso','$FrecR','$FrecC','$Esta_Ani','$reco','$Costo_Visita')";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert ("Registro exitoso");</script>';
        echo '<script>window.location="Visitas.php"</script>';
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
            <h1>Formulario Visitas</h1>
        </section>
        <table class="centrar">
           <form method="POST" name="frmadd" autocomplete="off">
           <tr>
            <td colspan="2">Datos Visita:</td>
          </tr>
          <tr>
            <td>Documento:</td>
               <td>
                  <select name="Docu">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($Docu1['id_usuario'])?>"><?php echo($Docu1['identificacion'])?></option>
                      <?php
                     }while($Docu1=mysqli_fetch_assoc($docu1));
                      ?>
                  </select> 
                </td>
          </tr>
             <tr>
                <td>Nombre:</td>
                <td>
                  <select name="Nom">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($Nombre['id_tipo_mascota'])?>"><?php echo($Nombre['nombre'])?></option>
                      <?php
                     }while($Nombre=mysqli_fetch_assoc($Nom_mas));
                      ?>
                  </select> 
                </td>
             </tr>
             <tr>
                <td>Estado Mascota:</td>
                <td>
                  <select name="EstaM">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($EstadoM['id_estado'])?>"><?php echo($EstadoM['tipo_estado'])?></option>
                      <?php
                     }while($EstadoM=mysqli_fetch_assoc($Esta_Masco));
                      ?>
                  </select> 
                </td>
             </tr>
             <tr>
                <td>Temperatura (°C):</td>
                <td><input type="number" name="Tem" placeholder="Temperatura Mascota"></td>
             </tr>
             <tr>
                <td>Peso(Kg):</td>
                <td><input type="number" name="Peso" placeholder="Peso mascota"></td>
             </tr>
             <tr>
                <td>Frecuencia Respiratoria:</td>
                <td><input type="number" name="FreR" placeholder="Frecuencia Respiratoria"></td>
             </tr>
             <tr>
                <td>Frecuencia Cardiaca:</td>
                <td><input type="number" name="FreC" placeholder="Frecuencia Cardiaca"></td>
            </tr>
            <tr>
                <td>Estado Animo:</td>
                <td><input type="text" name="EstaAnimo" placeholder="Estado Animo"></td>
            </tr>
            <tr>
                <td>Recomendaciones:</td>
                <td><input type="text" name="Reco" placeholder="Recomendaciones"></td>
            </tr>
            <tr>
                <td>Costo Visita:</td>
                <td><input type="number" name="CostoVisita" placeholder="$"></td>
            </tr>
            <tr>
                <td>Fecha:</td>
                <td><input type="date" name="fecha_" placeholder="Fecha"></td>
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