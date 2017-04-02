<?php require_once('../DBconnection.php');
    /*mantener conectado*/
    if(!isset($_SESSION))session_start();
    if(!$_SESSION[user_id]){
        $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }

    if(isset($_POST[eliminar]) && $_POST[eliminar]<>""){
        $eliminar_query = "DELETE FROM `usuarios` WHERE `usuarios`.`id_usuario` = '$_POST[id_us]'";
        $connection->query($eliminar_query);
        $ID = $connection->insert_id; 
        if($connection->query($eliminar_query))header("Location: usuarios.php");
    }


    $query_sel = "SELECT * FROM `usuarios` where id_usuario = '$_GET[id_user]'";
    $result_sel = $connection->query($query_sel);
    $user = $result_sel->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha de usuario</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <?php include('../header.php');?>
    <?php include('../nav-usuario.php');?>
    <?php include('user-sesion_adm.php');?>
    
    <h1 class="title-page">Ficha de usuario</h1>
    <table class="usuario">
        <tr>
            <td>Nombre</td>
            <td><?php echo $user[nombre];?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $user[email];?></td>
        </tr>
        <tr>
            <td>Teléfono</td>
            <td><?php echo $user[telefono];?></td>
        </tr>
        <tr>
            <td>País</td>
            <td><?php echo $user[pais];?></td>
        </tr>
        <tr>
            <td>Direccion</td>
            <td><?php echo $user[direccion];?></td>
        </tr>
        <tr>
            <td>Nombre usuario</td>
            <td><?php echo $user[username];?></td>
        </tr>
        <tr>
            <td>Contraseña</td>
            <td><?php echo $user[password];?></td>
        </tr>
    </table>
    
    <form action="" method="post" class="form-usuario">
        <input type="text" name="id_us" value="<?php echo $user[id_usuario];?>" hidden>
        <input class="btn eliminar" type="submit" name="eliminar" value="eliminar" onclick="return confirm('Desea eliminar este usuario');">
        <button class="btn modificar"><a class="" href="modificar-usuario.php?id_user=<?php echo $user[id_usuario]?>">Modificar</a></button>
    </form>
    <?php include('../footer.php');?>
</body>
</html>