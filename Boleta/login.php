<?php require_once("DBconnection.php");
    
//consulta si sesión ya está iniciada
if(!isset($_SESSION))session_start();
if((isset($_POST[username]) && $_POST[username]<>"") && (isset($_POST[password]) && $_POST[password]<>"") ){
    $query="SELECT * FROM `rayitasdb_usuarios` where `username`='$_POST[username]' AND `password`='$_POST[password]'";
    $resultado=$connection->query($query);
    
    if($total = $resultado->num_rows){
         $usuario = $resultado->fetch_assoc();
         $_SESSION[user_id]=$usuario[id_usuario];
         $_SESSION[user_name]=$usuario[nombre];
         $_SESSION[user_mail]=$usuario[email];
         $_SESSION[user_fono]=$usuario[telefono];
         $_SESSION[user_pais]=$usuario[pais];
         $_SESSION[user_direc]=$usuario[direccion];
         $volver=($_SESSION[volver])?$_SESSION[volver]:"index.php";
         header("Location: ".$volver);
    } else {
     $error="Usuario/Clave no registrados";
    }
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <?php include('header.php'); ?>
        <?php include('nav.php'); ?>

        <!--ingresar form-->
        <form method="post" class="user-table">
            <label for="username"> usuario: </label>
            <input type="text" name="username" id="username" />
            <br />
            <label for="password"> Contraseña: </label>
            <input type="password" name="password" id="password" />
            <br />
            <input type="submit" name="ingresar" id="ingresar" value="ingresar" class="btn modificar" />
          </form>
        <br>
        <?php echo $error; ?>
        <?php include('footer.php'); ?>
    </body>

    </html>