<?php require_once('../DBconnection.php');
     /*mantener conectado*/
    if(!isset($_SESSION))session_start();
    if(!$_SESSION[user_id]){
        $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }
    
    $query_sel = "SELECT * FROM `usuarios` where id_usuario = '$_GET[id_user]'";
    $result_sel = $connection->query($query_sel);
    $user = $result_sel->fetch_assoc();


    if(isset($_POST[modificar]) && $_POST[modificar]=="modificar"){
        $usuario_id = $_POST[id_us];
    $modificar_query = "UPDATE `usuarios` SET `nombre` = '$_POST[nombre]',`email` = '$_POST[mail]',`telefono` = '$_POST[fono]',`pais` = '$_POST[pais]',`direccion` = '$_POST[direccion]',`username` = '$_POST[username]',`password` = '$_POST[password]' WHERE `id_usuario` = '$_POST[id_us]'";
    $connection->query($modificar_query);
    $ID = $connection->insert_id; 
    if($connection->query($modificar_query))header("Location: ficha-usuario.php?id_user=$usuario_id");
   }

    $paises = array('Alemania','Argentina', 'Brasil', 'Bolivia', 'Chile', 'Colombia', 'Ecuador', 'EEUU', 'Francia', 'Inglaterra', 'México','Perú', 'Venezuela');

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar usuario</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
   <?php include('../header.php');?>
    <?php include('../nav-usuario.php');?>
    <?php include('user-sesion_adm.php');?>
    
    <h1 class="title-page">Modificar Usuario</h1>
    <form action="" method="post" class="registro-form modificar-registro">
        
         <input type="text" name="id_us" value="<?php echo $user[id_usuario];?>" hidden>
         <label for="nombre" class="one-col">Nombre:</label>
          <input type="text" placeholder="Nombre:" name="nombre" class="one-col" id="nombretxt" value="<?php echo $user[nombre];?>" required>
          <label for="mail" class="one-col">E-mail:</label>
          <input type="email" placeholder="E-mail:" name="mail" class="one-col" id="mailtxt" value="<?php echo $user[email];?>" required>
          <label for="fono" class="one-col">Teléfono:</label>
          <input type="tel" placeholder="Teléfono:" name="fono" class="two-col" id="fonotxt" value="<?php echo $user[telefono];?>">
          <label for="pais" class="one-col">País:</label>
          <select name="pais" id="paissel" class="one-col" required>
            <option value="null" disabled>-Seleccione País-</option>
            <option value="<?php echo $user[pais];?>" disabled selected><?php echo $user[pais];?></option>
             <?php foreach($paises as $pais){?>
                 <?php if ($pais!=$user[pais]){?>
                    <option value="<?php echo $pais;?>"><?php echo $pais;?></option>
                  <?}?>
              <?}?>
          </select>
          <label for="direccion" class="one-col">Direccion:</label>
          <textarea name="direccion" id="dirrecion" class="one-col"><?php echo $user[direccion];?></textarea>
          <br><br>
          <hr class="input-divider one-col">
          <label for="username" class="one-col">Username:</label>
          <input type="text" placeholder="Nombre de usuario:" name="username" class="one-col" id="usertxt" value="<?php echo $user[username];?>" required>
          <label for="password" class="one-col">Contraseña:</label>
          <input type="text" placeholder="Contraseña:" name="password" class="one-col" id="passtxt" value="<?php echo $º;?>" required>
          <div class="btns">
              <input type="button" onclick="history.go(-1);" class="btn eliminar" name="cancelar" value="cancelar">
            <input type="submit" class="btn modificar" name="modificar" value="modificar">
          </div>
      </form>
      <?php include('../footer.php');?>
</body>
</html>