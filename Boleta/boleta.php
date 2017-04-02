<?php require_once("DBconnection.php");?>
<?php
    
    
    if(!isset($_SESSION))session_start();
        if(!$_SESSION[user_id]){
            $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }
    
    if(isset($_GET[id_comp]) && $_GET[id_comp]<>""){
        $eliminar_query = "DELETE FROM `rayitasdb_compras` WHERE `rayitasdb_compras`.`id_compra` = '$_GET[id_comp]'";
        $connection->query($eliminar_query);
    }
    
    $consulta = "SELECT * FROM `rayitasdb_compras` WHERE 1 and cliente='$_SESSION[user_id]'";
    $resultado = $connection->query($consulta);
    $total = $resultado->num_rows;
    

?> 

<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Rayita SA</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
		<?php require('header.php');?>
        <?php include('nav.php');?>
        <?php include('user-sesion.php');?>
        
        <table class="tabla-compra">
            <tr>
                <th>Producto</th>    
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
            <!--calculo-->
            <?php while($compra = $resultado->fetch_assoc()){?>
            <tr>
                <td><?php echo $compra[nombre_producto];?></td>
                <td>$<?php echo number_format($compra[precio]);?></td>
                <td><?php echo $compra[cantidad]; $cal = $compra[cantidad] * $compra[precio];?></td>
                <td>$<?php echo number_format($cal);?></td>
                <td><a href="modificar.php?id_comp=<?php echo $compra[id_compra]; ?>&cod_prod=<?php echo $compra[codigo];?>">Modificar</a></td>
                <td><a href="boleta.php?id_comp=<?php echo $compra[id_compra]; ?>">Eliminar</a></td>
            </tr>
            <?php
            $calculo=$calculo+$cal;
            }
            ?>
            <!--costo de envío-->
            <?php
            if($calculo >= 50000){
                $envio = 0;
                $descuento = true;
            }else if($calculo >= 25000){
                $envio = 2000;
            }else if($calculo > 0){
                $envio = 5000;
            };
            ?>
            <tr class="cspan">
                <td colspan="3">+Costo de envío</td>
                <td>$<?php echo number_format($envio, 0, ",", ".");?></td>
            </tr>
            <!--subtotal-->
            <?php
            if(!$calculo){
                $subtotal = 0;
            }else{
                $subtotal = $calculo + $envio;
            };
            ?>
            <tr class="cspan subTotal">
                <td colspan="3">Subtotal</td>
                <td>$<?php echo number_format($subtotal, 0, ",",".");?></td>
            </tr>
            <!--descuento-->
            <?php
            if($descuento){
                $descuento = $subtotal * 0.10;
                $cadenaDscto .= '<tr class="cspan descuento">';
                $cadenaDscto .=      '<td colspan="3">-Descuento 10%</td>';
                $cadenaDscto .=      '<td>' . '$' . number_format($descuento, 0, ',', '.') . '</td>';
                $cadenaDscto .= '</tr>';
            };
            ?>
            <?php echo $cadenaDscto;?>
            <!--iva-->
            <?php $iva = ($subtotal-$descuento) * 0.19;?>
            <tr class="cspan iva">
                <td colspan="3">+Iva 19%</td>
                <td>$<?php echo number_format($iva, 0, ",",".");?></td>
            </tr>
            <!--total-->
            <?php $total = $subtotal + $iva;?>
            <tr class="cspan total">
                <td colspan="3">Total final</td>
                <td>$<?php echo number_format($total, 0, ",",".");?></td>
            </tr>            
        </table>
        
        <?php include('footer.php');?>
    </body>
</html>