<?php require_once('DBconnection.php');

if(isset($_POST[contacto]) && $_POST[contacto]="contacto"){
        
    $user_contact = "nxayancanxg@gmail.com";
    $asunto_contact = "contacto desde sitio web";
    $mensaje_contact = "El usuario ". $_POST['mail'] . " (" .$_POST[name] . ") desea contactarse:
    Asunto:" . $_POST['asunto']."
    Mensaje:" . $_POST['mensaje']."
    --Fin del mensaje--
    ";
    $cabecera_contact = "From: <mail@mail.com>\n\r";
    
    if(mail($user_contact, $asunto_contact, $mensaje_contact, $cabecera_contact)){
        $ok = "OK";
    }else{
        $error = "Error";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <?php include ('header.php'); ?>
   <?php include ('nav.php'); ?>
    <div class="contacto">
       <h1>Formulario de contacto</h1>
        <form action="" method="post">
            <input type="text" name="name" value="" placeholder="Nombre:" class="input-50">
            <input type="email" name="mail" placeholder="Mail:" class="input-50">
            <input type="text" name="asunto" placeholder="Asunto:" class="input-100">
            <textarea name="mensaje" cols="30" rows="10" placeholder="Mensaje"></textarea>
            <input type="submit" name="contacto" value="Enviar" class="submitbtn">
        </form>
    </div>
    <?php 
        if($error){
            echo $error;
        }else if($ok){
            echo $ok;
        }
    ?>
    <?php include ('footer.php'); ?>
</body>
</html>