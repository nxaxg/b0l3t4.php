<?php require_once('DBconnection.php');?>
<?php
if(!isset($_SESSION))session_start();
if(!$_SESSION[user_id]){
    $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING'];
    header("Location: login.php");
}

//variables
$max=5;
$page=0;
$self = $_SERVER['PHP_SELF'];
$buscar = $_GET[buscar];
$filtro = $_GET[filtro];

//obtener numero de pagina
if(isset($_GET[page]) && $_GET[page]<>""){
	$page = $_GET[page];	
}

$inicio = $page * $max;

//queries

//si se realiza la busqueda
if(isset($_GET[buscar])){
    //query para buscar segùn campo de busqueda
    $query = "SELECT * FROM `productos` WHERE `$filtro` LIKE '%$buscar%' ORDER BY `id_producto` asc";
    $query_limit = $query." limit $inicio,$max";
    //envìa querybuscar como query a la BD
    $resource = $connection->query($query_limit);
    //mensaje segun resultado de busqueda
    $busqueda = "<p class='res-busqueda'>Resultado de búsqueda por <strong>$filtro: '$buscar'</strong>.</p>";
}else{
    $query = "SELECT * FROM `productos` where 1 order by `id_producto` asc";
    $query_limit = $query." limit $inicio,$max";
    //de no realizar busqueda, que muestre todos los resultados de la BD
    $resource = $connection->query($query_limit);
}


if(isset($_GET[total]) && $_GET[total]<>""){
	$total = $_GET[total];
}else{
	$todos = $connection->query($query);
	$total = $todos->num_rows;
}

$totalpages = ceil($total/$max)-1;


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
    
    <!--formulario de busqueda -->
    <form action="<?php echo $self ?>" method="get" class="busqueda">
        <select name="filtro">
            <option value="nombre">Nombre</option>
            <option value="precio">Precio</option>
            <option value="codigo">Codigo</option>
            <option value="frase_promocional">Frase promocional</option>
        </select>
        <input type="search" name="buscar">
        <input type="submit" name="submit" value="Buscar">
    </form>
    <?php echo $busqueda ?>
    <!---->
    
 	<?php if($total){?>
    
    <table class="table-index">
        <tr>
            <th>Nombre producto</th>
            <th>Precio</th>
        </tr>
        <?php while($row = $resource->fetch_assoc()){?>
        <tr>
            <td>
                <p>
                    <img id="img-index" src="img/<?php echo $row[codigo]?>.jpg" alt="">
                </p>
                <p>
                	<a href="ficha.php?id_prod=<?php echo $row[id_producto]?>">
                		<?php echo $row[nombre];?>
                	</a>
                </p>
                <p>
                	<?php echo $row[frase_promocional];?>
                </p>
            </td>
            <td>
            	<strong>$<?php echo number_format($row[precio]);?></strong>
            </td>
        </tr>
        <?php }?>        
    </table>
    <?php }else{ ?>
    <p>No hay resultados que mostrar</p>
    <?php }?>
    
    <div class="paginacion">
    <?php if(($page -1)>=0){?>
    	<a href="<?php echo $self?>?page=<?php echo $page-1 ?>">anterior</a>
	<?php }?>
    
	<?php echo $inicio + 1 ?> a <?php echo min($inicio +$max, $total)?> de <?php echo $total?>
    
    <?php if(($page+1)<=$totalpages){?>
    	<a href="<?php echo $self?>?page=<?php echo $page+1 ?>">siguiente</a>
     <?php }?>
    </div>

    <?php include('footer.php');?>
</body>
</html>