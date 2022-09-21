
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
$sql1 = "SELECT * FROM tipo_usuario";
$tp_usu = mysqli_query($mysqli, $sql1) or die(mysqli_error());
$usua1 = mysqli_fetch_assoc($tp_usu);

$sql2 = "SELECT * FROM usuario";
$tp_usu2 = mysqli_query($mysqli, $sql2) or die(mysqli_error());
$usua2 = mysqli_fetch_assoc($tp_usu2);
?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {
    $tp=$_POST ['Doc'];
    $sqladd="SELECT *FROM usuario WHERE identificacion='$tp'";
    $query = mysqli_query($mysqli,$sqladd);
    $fila = mysqli_fetch_assoc($query);
    if($fila){
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="AgregarUsuario.php"</script>';
    }
    else
       if($_POST['Doc']=="" || $_POST['Nom']=="" || $_POST['Ape']=="" || $_POST['Dir']=="" || $_POST['Tel']=="" || $_POST['Corr']=="" || $_POST['pass']=="" || $_POST['Tar']=="" || $_POST['Id_tp']=="" || $_POST['id_estado']==""){
        echo '<script>alert ("Existen campos vacios");</script>';
        echo '<script>window.location="AgregarUsuario.php"</script>';
    }
    else{
        $iden=$_POST ['Doc'];
        $nombre=$_POST ['Nom'];
        $apellidos=$_POST ['Ape'];
        $direccion=$_POST ['Dir'];
        $telefono=$_POST ['Tel'];
        $correo=$_POST ['Corr'];
        $password=$_POST ['pass'];
        $targetaP=$_POST ['Tar'];
        $TipoUsuario=$_POST ['Id_tp'];
        $estado=$_POST ['id_estado'];

        $sqladd="INSERT INTO usuario(id_tipo_usuario, id_estado, password, identificacion, nombre, apellido, telefono, correo, dirrecion, tarjeta_profesional`) VALUES ('$iden','$nombre','$apellidos','$direccion','$telefono','$correo','$password','$targetaP','$TipoUsuario','$estado')";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert ("Registro exitoso");</script>';
        echo '<script>window.location="Usuarios.php"</script>';
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
            <h1>Formulario crear usuarios:<?php echo $usua['tipo_usuario']?></h1>
        </section>
        <table class="centrar">
           <form method="POST" name="frmadd" autocomplete="off">
             <tr>
                <td colspan="2">Tipos de usuarios</td>
             </tr>
             <tr>
                <td>Identificador:</td>
                <td><input type="text" name="Doc" placeholder="Ingrese su documento"></td>
             </tr>

             <tr>
                <td>Nombres:</td>
                <td><input type="text" name="Nom" placeholder="Ingrese los Nombres" style="text-transform:uppercase;"></td>
             </tr>
             <tr>
                <td>Apellidos:</td>
                <td><input type="text" name="Ape" placeholder="Ingrese los Apellidos" style="text-transform:uppercase;"></td>
             </tr>
             <tr>
                <td>Direccion:</td>
                <td><input type="text" name="Dir" placeholder="Ingrese la direccion" style="text-transform:uppercase;"></td>
             </tr>
             <tr>
                <td>Telefono:</td>
                <td><input type="number" name="Tel" placeholder="Ingrese el numero telefonico"></td>
             </tr>
             <tr>
                <td>Correo:</td>
                <td><input type="email" name="Corr" placeholder="Ingrese el Email" style="text-transform:uppercase;"></td>
             </tr>
             <tr>
                <td>Password:</td>
                <td><input type="password" name="pass" placeholder="Ingrese el password"></td>
             </tr>
             <tr>
                <td>Targeta profesional:</td>
                <td><input type="number" name="Tar" placeholder="Ingrese el numero targeta profesional" value="0"></td>
            </tr>
            
             <tr>
                <td>Tipo usuario:</td>
                <td>
                  <select name="Id_tp">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($usua1['id_tipo_usuario'])?>"><?php echo($usua1['tipo_usuario'])?>
                      <?php
                     }while($usua1=mysqli_fetch_assoc($tp_usu));
                      ?>
                  </select> 
                </td>
             </tr>

             <tr>
                <td>Tipo Estado:</td>
                <td>
                  <select name="id_estado">
                     <option value="">Seleccione una opcion </option>
                     <?php
                     do {                  
                     ?>
                     <option value="<?php echo($usua2['usuario'])?>"><?php echo($usua2['id_estado'])?>
                      <?php
                     }while($usua2=mysqli_fetch_assoc($tp_usu2));
                      ?>
                  </select> 
                </td>
             </tr>
             <tr>
                <td>Fecha:</td>
                <td> <input type="date"></td>
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