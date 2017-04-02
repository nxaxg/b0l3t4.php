<?php require_once("DBconnection.php");
    
if(!isset($_SESSION))session_start();
        if(!$_SESSION[user_id]){
            $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
        }
    
if(isset($_POST[comprar]) && $_POST[comprar] == "comprar"){
    $cliente = $_POST['cliente'];
    $nombre_producto = $_POST['nombre_producto'];
    $codigo = $_POST['codigo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $queryinsert = "INSERT INTO `rayitasdb_compras`(`cliente`, `codigo`, `nombre_producto`, `precio`, `cantidad`) values('$cliente', '$codigo', '$nombre_producto', '$precio', '$cantidad')";
        
    $connection->query($queryinsert);
    $mensaje = "exito";
    
    $ID = $connection->insert_id;
    if($ID)header("Location: boleta.php");
    
}else{
    $mensaje = "error";
}


$id_producto = $_GET['id_prod'];
$self = $_SERVER['PHP_SELF'];

$query = "select * from `rayitasdb_productos` where `id_producto` = ".$id_producto;
$resultado = $connection->query($query);
$producto = $resultado->fetch_assoc();

if($producto[disponibilidad]){
    $disponibilidad = "Disponible";
}else{
    $disponibilidad = "No disponible";
}

if($producto[promocion]){
    $promocion = "En promoción";
}else{
    $promocion = "Sin promocion";
}

if($producto[color]=='rojo'){
    $color = "red";
}else if($producto[color]=='verde'){
    $color = "green";
}else{
    $color = "blue";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include('header.php');?>
    <?php include('nav.php');?>
    <?php include('user-sesion.php');?>
    
    <div class="ficha-prod">
        <h1 class="prod-title"><?php echo $producto[nombre]; ?></h1>
        <h2 class="prod-cod">Código: <?php echo $producto[codigo]; ?></h2>
        <ul class="min-info">
            <li><?php echo formatFecha($producto[fecha]); ?></li>
            <li class="upper"><?php echo $producto[categoria]; ?></li>
            <li class="upper" style="background-color:<?php echo $color?>"><?php echo $producto[color]; ?></li>
            <li><?php echo $disponibilidad ?></li>
            <li><?php echo $promocion ?></li>
        </ul>
        <figure>
            <img src="img/<?php echo $producto[codigo];?>.jpg" alt="Imagen producto">
        </figure>
        <div class="desc-prod">
            <p class="frase-prom"><?php echo $producto[frase_promocional]; ?></p>
            <h3>Descripción:</h3>
            <p><?php echo $producto[descripcion] ?>.</p>
        </div>
        
        <!--formulario-->
        <form method="post" action="" class="compra">
           <!--hidden inputs-->
           <input type="hidden" name="cliente" id="cliente" value="<?php echo $_SESSION[user_id];?>" >
            <input type="hidden" name="nombre_producto" id="nombre_producto" value="<?php echo $producto[nombre];?>">
            <input type="hidden" name="codigo" id="codigo" value="<?php echo $producto[codigo];?>">
            <input type="hidden" name="precio" id="precio" value="<?php echo $producto[precio];?>">
            
            
            <div class="left">
                <p>Precio:</p>
                <p>$<strong><?php echo number_format($producto[precio]) ?></strong></p>
            </div>
            <div class="right">
                <label for="cantidad"><p>Cantidad:</p></label>
                <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" max="20" min="1" value="1">
            </div>
            <input type="submit" name="comprar" value="comprar" id="comprarbtn">
        </form>
    </div>
    <?php include('footer.php');?>
</body>
</html>