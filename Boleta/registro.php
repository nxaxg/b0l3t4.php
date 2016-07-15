<?php require_once("DBconnection.php");
 /*mantener conectado*/
    if(!isset($_SESSION))session_start();
    if(!$_SESSION[user_id]){
        $_SESSION[volver]=$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_ STRING']; header("Location: login.php");
    }

 if(isset($_POST[registrar]) && $_POST[registrar]=="registrar"){
    $nombre = $_POST['nombre'];
    $mail = $_POST['mail'];
    $fono = $_POST['fono'];
    $pais = $_POST['pais'];
    $direccion = $_POST['direccion'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO `usuarios` (`nombre`, `email`, `telefono`, `pais`, `direccion`, `username`, `password`) VALUES ('$nombre', '$mail', '$fono', '$pais', '$direccion', '$username', '$password')";
    $connection->query($query);
     $ID = $connection->insert_id;
    if($ID)header("Location: index.php");
     
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
    <title>Registro | Rayitas S.A.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
 
   <?php include('header.php');?>
   <?php include('nav.php');?>
   <?php include('adm/user-sesion_adm.php');?>
   <?php
    $paises = array('Alemania','Argentina', 'Brasil', 'Bolivia', 'Chile', 'Colombia', 'Ecuador', 'EEUU', 'Francia', 'Inglaterra', 'México','Perú', 'Venezuela');
    
    ?>
   <!--registro-->
   <section class="registro">
     <h2 class="title-page">Registro de usuario</h2>
     
      <form action="" method="post" class="registro-form">
          <input type="text" placeholder="Nombre:" name="nombre" class="two-col" id="nombretxt" required>
          <input type="email" placeholder="E-mail:" name="mail" class="two-col" id="mailtxt" required>
          <input type="tel" placeholder="Teléfono:" name="fono" class="two-col" id="fonotxt" >
          <select name="pais" id="paissel" class="two-col" required>
            <option value="null">-Seleccione país de residencia-</option>
             <?php foreach($paises as $pais){?>
              <option value="<?php echo $pais;?>"><?php echo $pais;?></option>
              <?}?>
          </select>
          <textarea name="direccion" class="one-col" placeholder="Dirección:"></textarea>
          <hr class="input-divider">
          <input type="text" placeholder="Nombre de usuario:" name="username" class="one-col" id="usertxt" required>
          <input type="password" placeholder="Contraseña:" name="password" class="one-col" id="passtxt" required>
          <input type="submit" class="submit btn" name="registrar" value="registrar">
      </form>
   </section> 
   <p class="mensaje-corr"><?php echo $message1;?></p>
   <p class="mensaje-error"><?php echo $message2;?></p>
   <!--registro-->
   <?php include('footer.php');?> 
</body>
</html>