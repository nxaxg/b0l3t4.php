<?php require_once('../DBconnection.php');
    /*mantener conectado*/
    if(!isset($_SESSION))session_start();
    if(!$_SESSION[user_id]){
        $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }

    if(isset($_GET[id_user]) && $_GET[id_user]<>""){
        $eliminar_query = "DELETE FROM `usuarios` WHERE `usuarios`.`id_usuario` = '$_GET[id_user]'";
        $connection->query($eliminar_query);
    }

    $query_sel = "SELECT * FROM `usuarios` where 1";
    $result_sel = $connection->query($query_sel);
    $total_sel = $result_sel->num_rows;

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('../header.php');?>
    <?php include('../nav-usuario.php');?>
    <?php include('user-sesion_adm.php');?>
    <h1 class="title-page">Listado de Usuarios</h1>
    
    <button class="btn agregar-btn">
        <a href="../registro.php">Agregar usuario</a>
    </button>
    
    <table class="user-table">
        <tr>
            <th>Nombre</th>
            <th>E-mail</th>
            <th>País</th>
            <th class="th-mini">Ver</th>
            <th class="th-mini">Editar</th>
            <th class="th-mini">Eliminar</th>
        </tr>
        <!---->
        <?php while($user = $result_sel->fetch_assoc()){?>
        <tr>
            <td><?php echo $user[nombre];?></td>
            <td><?php echo $user[email];?></td>
            <td><?php echo $user[pais];?></td>
            <td><a href="ficha-usuario.php?id_user=<?php echo $user[id_usuario]?>">Ver</a></td>
            <td><a href="modificar-usuario.php?id_user=<?php echo $user[id_usuario]?>">Modificar</a></td>
            <td><a href="usuarios.php?id_user=<?php echo $user[id_usuario]?>" onclick="return confirm('Desea eliminar este usuario');">Eliminar</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php include('../footer.php');?>
</body>
</html>