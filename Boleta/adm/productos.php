<?php require_once('../DBconnection.php');
    
    /*mantener conectado*/
    if(!isset($_SESSION))session_start();
    if(!$_SESSION[user_id]){
        $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }


    if(isset($_GET[id_prod]) && $_GET[id_prod]<>""){
        $eliminar_query = "DELETE FROM `rayitasdb_productos` WHERE `rayitasdb_productos`.`id_producto` = '$_GET[id_prod]'";
        $connection->query($eliminar_query);
    }

    $query_sel = "SELECT * FROM `rayitasdb_productos` where 1";
    $result_sel = $connection->query($query_sel);
    $total_sel = $result_sel->num_rows;

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include('../header.php');?>
    <?php include('../nav-usuario.php');?>
    <?php include('user-sesion_adm.php');?>
    <h1 class="title-page">Listado de productos</h1>
    
    <button class="btn agregar-btn">
        <a href="agregar-producto.php">Agregar Producto</a>
    </button>
    
    <table class="user-table">
        <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Color</th>
            <th class="th-mini">Ver</th>
            <th class="th-mini">Editar</th>
            <th class="th-mini">Eliminar</th>
        </tr>
        <!---->
        <?php while($prod = $result_sel->fetch_assoc()){?>
        <tr>
            <td><?php echo $prod[nombre];?></td>
            <td><?php echo $prod[categoria];?></td>
            <td><?php echo $prod[color];?></td>
            <td><a href="ficha-producto.php?id_prod=<?php echo $prod[id_producto]?>">Ver</a></td>
            <td><a href="modificar-producto.php?id_prod=<?php echo $prod[id_producto]?>">Modificar</a></td>
            <td><a href="productos.php?id_prod=<?php echo $prod[id_producto]?>" onclick="return confirm('Desea eliminar este Producto');">Eliminar</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php include('../footer.php');?>
</body>
</html>