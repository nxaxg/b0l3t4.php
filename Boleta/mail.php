<?php

$destinatario = "mau.riverag@alumnos.duoc.cl";
$asunto = "asunto";
$cuerpo =
"  /\_/\
=( °w° )=
  )   (  //
 (__ __)//";

$cabecera = "From: <nxayancanxg@gmail.com>";
$cabecera .= "Return Path: <ib.perez@alumnos.duoc.cl>";


if(mail($destinatario, $asunto, $cuerpo, $cabecera)){
    $mensaje = "OK";
}else{
    $mensaje = ":(";
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mail</title>
</head>
<body>
    <?php echo $mensaje; ?>
</body>
</html>