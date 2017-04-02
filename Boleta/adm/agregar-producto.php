<?php require_once("../DBconnection.php");
/*mantener conectado*/
    if(!isset($_SESSION))session_start();
    if(!$_SESSION[user_id]){
        $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }


 if(isset($_POST[registrar]) && $_POST[registrar]=="registrar"){
    $nombre = $_POST['nombre'];
    $codigo = "nuevoprod";
    $fraseprom = $_POST['fraseprom'];
    $descripcion = $_POST['descripcion'];
    $categoriasel = $_POST['categoria'];
    $colorsel = $_POST['color'];
    $precio = $_POST['precio'];
    $fecha = date("Y-m-d H:i:s");

    $query = "INSERT INTO `productos` (`nombre`, `codigo`, `categoria`, `frase_promocional`, `descripcion`, `color`, `precio`, `disponibilidad`,`promocion`,`fecha`) VALUES ('$nombre', '$codigo', '$categoriasel', '$fraseprom', '$descripcion', '$colorsel', '$precio','1','1','$fecha')";
    $connection->query($query);
     
     $ID = $connection->insert_id;
    if($ID)header("Location: productos.php");
     
}else{
    error();
}

    function error(){
        $message2 = "ERROR: Could not able to execute $query. " . mysqli_error($connection);
        return $message2;
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar producto | Rayitas S.A.</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
 
   <?php include('../header.php');?>
   <?php include('../nav-usuario.php');?>
   <?php include('user-sesion_adm.php');?>
   
   <?php
    $categorias = array('Vertical', 'Horizontal', 'Curva', 'Diagonal');
    $colores = array('Azul', 'Verde', 'Rojo');
    
    ?>
   <!--registro-->
   <section class="registro">
     <h2 class="title-page">Agregar producto</h2>
     
      <form action="" method="post" class="registro-form">
          <input type="text" placeholder="Nombre:" name="nombre" class="two-col" id="nombreprodtxt" required>
          <select name="categoria" id="categsel" class="two-col" required>
            <option value="null" disabled selected>-Seleccione categoria-</option>
             <?php foreach($categorias as $categoria){?>
              <option value="<?php echo $categoria;?>"><?php echo $categoria;?></option>
              <?}?>
          </select>
          <select name="color" id="colorsel" class="two-col" required>
            <option value="null" disabled selected>-Seleccione color-</option>
             <?php foreach($colores as $color){?>
              <option value="<?php echo $color;?>"><?php echo $color;?></option>
              <?}?>
          </select>
          <textarea name="descripcion" id="descprod" placeholder="Descripcion"></textarea>
          <textarea name="fraseprom" id="fraseprod" placeholder="Frase Promocional"></textarea>
          <input type="text" placeholder="Precio: $" name="precio" class="two-col" id="preciotxt" required>
          <input type="submit" class="submit" name="registrar" value="registrar">
          <?php ;?>
      </form>
   </section>
   <!--registro-->
   <?php include('../footer.php');?> 
</body>
</html>