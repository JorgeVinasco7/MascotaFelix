<?php
require_once("../db/connection.php");
session_start();

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) 
{
$contra = $_POST['cont'];

if ($_POST['cont']== "" || $_POST['conta']== "" )
	{
                 echo '<script>alert (" Datos Vacios");</script>';
                 echo '<script>window.location="../validarcorreo.html"</script>';
	}
	else
	{
    
        $doc = $_SESSION['pass'];
        $insertSQL = "UPDATE usuario SET password ='$contra'  WHERE password = '$doc'";
        mysqli_query($mysqli, $insertSQL) or die(mysqli_error());  	
             echo '<script>alert (" Cambio de Clave Existosa ");</script>';
            echo '<script>window.location="../login.html"</script>';
    
    }
   
}
?>
<?php
if($_POST["inicio"])
{
	// inicia sesion para los usuarios
    //parte del codigo para validar
    // hacemos un cambio para llevarlo a la nube
	$doc = $_POST["doc"];
    $cor = $_POST["cor"];
	$sql="select * from usuario where identificacion = '$doc'"; 
    $sql="select * from usuario where correo = '$cor'"; 	
	$query=mysqli_query($mysqli, $sql);
	$fila=mysqli_fetch_assoc($query);
	
	if($fila)
    {		
		/// si el usuario y correo son correctas creamos una variable global passs para cambiarn el password
        $_SESSION['pass']=$fila['password'];
    ?>
        <html>
            <head>
                <link rel="stylesheet" href="../controller/css/style.css">
                <meta charset="utf-8">
            </head>
            <body>
                <div class="login-box">
                    <!--crea una caja imaginaria-->
                    <img src="controller/image/icono1.jpg" class="avatar" alt="Avatar Image">

                        <!--insertamos una imagen-->
    
                        <form  method="post"  name="form1" id="form1" autocomplete="off" >
                            <!--crea formularios-->
                            <label for="usuario">Nueva Contraseña</label>
                            <!-- etiqueta lo que se le muestra el usuario -->
                            <input type="text" name="cont" id="cont" placeholder="Nueva Clave" >
                            <label for="usuario">Confirme Contraseña</label>
                            <!-- etiqueta lo que se le muestra el usuario -->
                            <input type="text" name="conta" id="conta" placeholder="Confirme Clave">
                            <!-- Caja de texto donde el usuario digite texto -->
                            <input type="submit" name="inicio" id="inicio" value="cambiar" >
                            <input type="hidden" name="MM_update" value="form1" />
                            <a href="../index.html">Volver Pagina Principal</a>
                             <!--TAREA VALIDA QQUE LAS DOS CONTRASEÑAS SEAN IGUALES Y QUE SEA FUERTE-->
                        </form>
            </body>
        </html>
    <?php
    }  
   else
    {
    echo '<script>alert (" El documento  y el correo no exite en la Base de Datos");</script>';
    echo '<script>window.location="../validarcorreo.html"</script>';
    }
}
?>