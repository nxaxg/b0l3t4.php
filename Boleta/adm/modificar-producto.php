<?php require_once('../DBconnection.php');
    /*mantener conectado*/
    if(!isset($_SESSION))session_start();
    if(!$_SESSION[user_id]){
        $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }


    $query_sel = "SELECT * FROM `productos` where id_producto = '$_GET[id_prod]'";
    $result_sel = $connection->query($query_sel);
    $prod = $result_sel->fetch_assoc();

    $cat_prod = array('Vertical','Horizontal','Curva', 'Diagonal');

    if(isset($_POST[modificar]) && $_POST[modificar]=="modificar"){
        $producto_id = $_POST[id_prod];
    $modificar_query = "UPDATE `productos` SET `nombre` = '$_POST[nombre]',`categoria` = '$_POST[categoria]',`descripcion` = '$_POST[descripcion]',`frase_promocional` = '$_POST[fraseprom]',`color` = '$_POST[color]',`precio` = '$_POST[precio]' WHERE `id_producto` = '$producto_id'";
    $connection->query($modificar_query);
    $ID = $connection->insert_id; 
    if($connection->query($modificar_query))header("Location: ficha-producto.php?id_prod=$producto_id");    
    }

    $categorias = array('vertical', 'horizontal', 'curva', 'diagonal');
    $colores = array('azul', 'verde', 'rojo');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <?php include('../header.php');?>
    <?php include('../nav-usuario.php');?>
    <?php include('user-sesion_adm.php');?>
    
    <h1 class="title-page">Modificar producto</h1>
    
    <form action="" method="post" class="registro-form modificar-registro">
         <input type="text" name="id_prod" value="<?php echo $prod[id_producto];?>" hidden>
         <label for="nombre" class="one-col">Nombre:</label>
          <input type="text" placeholder="Nombre:" name="nombre" class="one-col" id="nombreprodtxt" value="<?php echo $prod[nombre];?>" required>
          <label for="categoria" class="one-col">Categoria:</label>
          <select name="categoria" id="categsel" class="one-col" required>
            <option value="null" disabled>-Seleccione categoria-</option>
            <option value="<?php echo $prod[categoria];?>" disabled selected><?php echo $prod[categoria];?></option>
             <?php foreach($categorias as $categoria){?>
                 <?php if ($categoria!=$prod[categoria]){?>
                    <option value="<?php echo $categoria;?>"><?php echo $categoria;?></option>
                  <?}?>
              <?}?>
          </select>
          <label for="descripcion" class="one-col">Descripción:</label>
          <textarea name="descripcion" id="descprod" class="one-col"><?php echo $prod[descripcion];?></textarea>
          <label for="fraseprom" class="one-col">Frase Promocional:</label>
          <textarea name="fraseprom" id="fraseprod" class="one-col"><?php echo $prod[frase_promocional];?></textarea>
          <label for="color" class="one-col">Color:</label>
          <select name="color" id="colorsel" class="one-col" required>
            <option value="null" disabled>-Seleccione color-</option>
            <option value="<?php echo $prod[color];?>" disabled selected><?php echo $prod[color];?></option>
             <?php foreach($colores as $color){?>
                 <?php if ($color!=$prod[color]){?>
                    <option value="<?php echo $color;?>"><?php echo $color;?></option>
                  <?}?>
              <?}?>
          </select>
          <label for="precio" class="one-col">Precio:</label>
          <input type="text" placeholder="Precio:" name="precio" class="one-col" id="preciotxt" value="<?php echo $prod[precio];?>" required>
          <div class="btns">
              <input type="submit" class="btn eliminar" name="cancelar" value="cancelar">
            <input type="submit" class="btn modificar" name="modificar" value="modificar">
          </div>
      </form>
      <?php include('../footer.php');?>
</body>
</html>