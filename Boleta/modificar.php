<?php require_once("DBconnection.php");

$id_comp = $_GET['id_comp'];
$cod_prod = $_GET['cod_prod'];

$query_prod = "select * from productos where codigo = ".$cod_prod;
$resultado_prod = $connection->query($query_prod);
$producto_cod= $resultado_prod->fetch_assoc();

$query_comp = "select * from compras where id_compra = ".$id_comp;
$resultado_comp = $connection->query($query_comp);
$compra = $resultado_comp->fetch_assoc();




if(isset($_POST[modificar]) && $_POST[modificar]=="modificar"){
    $modificar_query = "UPDATE `compras` SET `cantidad` = '$_POST[cantidad]' WHERE `id_compra` = '$id_comp'";
    $connection->query($modificar_query);
    $ID = $connection->insert_id; 
    if($connection->query($modificar_query))header("Location: boleta.php");
    
}else{
    
}


if($producto_cod[disponibilidad]){
    $disponibilidad = "Disponible";
}else{
    $disponibilidad = "No disponible";
}

if($producto_cod[promocion]){
    $promocion = "En promoción";
}else{
    $promocion = "Sin promocion";
}

if($producto_cod[color]=='rojo'){
    $color = "red";
}else if($producto_cod[color]=='verde'){
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
    <div class="ficha-prod">
        <h1 class="prod-title"><?php echo $producto_cod[nombre]; ?></h1>
        <h2 class="prod-cod">Código: <?php echo $producto_cod[codigo]; ?></h2>
        <ul class="min-info">
            <li><?php echo formatFecha($producto_cod[fecha]); ?></li>
            <li class="upper"><?php echo $producto_cod[categoria]; ?></li>
            <li class="upper" style="background-color:<?php echo $color?>"><?php echo $producto_cod[color]; ?></li>
            <li><?php echo $disponibilidad ?></li>
            <li><?php echo $promocion ?></li>
        </ul>
        <figure>
            <img src="img/<?php echo $producto_cod[codigo];?>.jpg" alt="Imagen producto">
        </figure>
        <div class="desc-prod">
            <p class="frase-prom"><?php echo $producto_cod[frase_promocional]; ?></p>
            <h3>Descripción:</h3>
            <p><?php echo $producto_cod[descripcion] ?>.</p>
        </div>
        
        <!--formulario-->
        <form method="post" action="" class="compra">
           <!--hidden inputs-->          
            <div class="left">
                <p>Precio:</p>
                <p>$ <input type="text" name="precio" id="precio" value="<?php echo $compra[precio];?>"></p>
            </div>
            <div class="right">
                <label for="cantidad"><p>Cantidad:</p></label>
                <input type="text" name="id" id="id" value="<?php echo $compra[id_compra];?>" hidden>
                <input type="number" name="cantidad" id="cantidad" value="<?php echo $compra[cantidad];?>" placeholder="Cantidad" max="100" min="1">
            </div>
            <div class="center">    
                <input type="submit" name="modificar" value="modificar" id="modificar" class="btn">
            </div>
        </form>
    </div>
    <?php include('footer.php');?>
</body>
</html>