<?php require_once('../DBconnection.php');
    /*mantener conectado*/
    if(!isset($_SESSION))session_start();
    if(!$_SESSION[user_id]){
        $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }

    if(isset($_POST[eliminar]) && $_POST[eliminar]<>""){
        $eliminar_query = "DELETE FROM `rayitasdb_productos` WHERE `rayitasdb_productos`.`id_producto` = '$_POST[id_prod]'";
        $connection->query($eliminar_query);
        $ID = $connection->insert_id; 
        if($connection->query($eliminar_query))header("Location: productos.php");
    }


    $query_sel = "SELECT * FROM `rayitasdb_productos` where `id_producto` = '$_GET[id_prod]'";
    $result_sel = $connection->query($query_sel);
    $prod = $result_sel->fetch_assoc();

    if($prod[disponibilidad]){
        $disponibilidad = "Disponible";
    }else{
        $disponibilidad = "No disponible";
    }

    if($prod[promocion]){
        $promocion = "En promoción";
    }else{
        $promocion = "Sin promocion";
    }

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha de producto</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <?php include('../header.php');?>
    <?php include('../nav-usuario.php');?>
    <?php include('user-sesion_adm.php');?>
    
    <h2 class="title-page">Ficha producto</h2>
    <table class="usuario">
        <tr>
            <td>Imagen de referencia</td>
            <td><img src="../img/<?php echo $prod[codigo];?>.jpg" alt=""></td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo $prod[nombre];?></td>
        </tr>
        <tr>
            <td>Categoria</td>
            <td><?php echo $prod[categoria];?></td>
        </tr>
        <tr>
            <td>Frase promocional</td>
            <td><?php echo $prod[frase_promocional];?></td>
        </tr>
        <tr>
            <td>Descripción</td>
            <td><?php echo $prod[descripcion];?></td>
        </tr>
        <tr>
            <td>Color</td>
            <td><?php echo $prod[color];?></td>
        </tr>
        <tr>
            <td>Precio</td>
            <td>$<?php echo $prod[precio];?></td>
        </tr>
        <tr>
            <td>Disponibilidad</td>
            <td><?php echo $disponibilidad;?></td>
        </tr>
        <tr>
            <td>Promoción</td>
            <td><?php echo $promocion;?></td>
        </tr>
        <tr>
            <td>Fecha de agregación</td>
            <td><?php echo formatFecha($prod[fecha]);?></td>
        </tr>
    </table>
    
    
    <form action="" method="post" class="form-usuario">
        <input type="text" name="id_prod" value="<?php echo $prod[id_producto];?>" hidden>
        <input class="btn eliminar" type="submit" name="eliminar" value="eliminar" onclick="return confirm('Desea eliminar este producto?');">
        <button class="btn modificar"><a href="modificar-producto.php?id_prod=<?php echo $prod[id_producto]?>">Modificar</a></button>
    </form>
    <?php include('../footer.php');?>
</body>
</html>