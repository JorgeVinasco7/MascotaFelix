<?php
  
  require_once("db/connection.php");

?>

<?php
    $control = "SELECT * From tipo_usuario WHERE id_tipo_usuario >= 5";
    $query=mysqli_query($mysqli,$control);
    $fila=mysqli_fetch_assoc($query);
?>


<?php
    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
    {
        $nombre=    $_POST['nombre'];
        $apellido=   $_POST['apellido'];
        $telefono= $_POST['telefono'];
        $correo = $_POST['correo'];
        $dirrecion=$_POST['dirrecion'];
        $identificacion= $_POST['identificacion'];
        $password=     $_POST['password'];
        $id_tipo_usuario = $_POST['id_tipo_usuario'];

        $validar ="SELECT * FROM usuario WHERE identificacion='$identificacion' or nombre='$nombre'";
        $queryi=mysqli_query($mysqli,$validar);
        $fila1=mysqli_fetch_assoc($queryi);
    
       if ($fila1) {
           echo '<script>alert ("DOCUMENTO O NOMBRE EXISTEN //CAMBIELOS//");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
       }
        else if ($nombre=="" || $apellido=="" || $telefono=="" || $correo=="" || $dirrecion=="" || $identificacion=="" || $password=="" || $id_tipo_usuario=="")
        {
            echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
           echo '<script>windows.location="registrousu.php"</script>';
        }

        else
        {

           $insertsql="INSERT INTO usuario(nombre,apellido,telefono,correo,dirrecion,identificacion,password,id_tipo_usuario) VALUES('$nombre','$apellido','$telefono','$correo','$dirrecion','$identificacion','$password','$id_tipo_usuario')";
           mysqli_query($mysqli,$insertsql) or die("Problemas al insertar".mysqli_error($mysqli));
           echo '<script>alert (" Registro Exitoso, Gracias");</script>';
           echo '<script>window.location="index.html"</script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="controller/css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="login-box1">
               
        <form method="POST" name="formreg" autocomplete="off">
            <label for="usuario"> <h1>REGISTRO DE USUARIO </h1></label> 
            <input type="text" name="nombre" placeholder="Ingrese los nombres:" >
            <input type="text" name="apellido" placeholder="Ingrese los apellidos:" >
            <input type="text" name="telefono" placeholder="Telefono:" >
            <input type="text" name="correo" placeholder="Ingrese el correo:" >
            <input type="text" name="dirrecion" placeholder="Ingrese la direccion:" >
            <input type="text" name="identificacion" placeholder="Ingrese un Usuario:" >
            <input type="password" name="password" placeholder="Ingrese un password:" >
            
            <!--select-->

            <select name="id_tipo_usuario">
                <option value="">Seleccione</option>
               
               <?php
                   do {
                
                ?>
                    <option value="<?php echo($fila['id_tipo_usuario'])?>"> <?php echo($fila['tipo_usuario'])?>

               <?php   
                   }while($fila=mysqli_fetch_assoc($query));
               
               ?>
            </select>


            <input type="submit" name="validar" value="Registrar">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>
    </div>
</body>
</html>