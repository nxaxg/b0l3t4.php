<?php
$host="localhost";
$user="nicolas_user";
$pass="white-pony";
$database="nicolas_general";


$connection = new mysqli($host, $user, $pass, $database);

/*if ($connection->connect_error) {
    die('Error de Conexión (' . $connection->connect_errno . ') '
            . $connection->connect_error);
}else{
echo 'Éxito... ' . $connection->host_info . "\n";
}*/

//library

    function formatFecha($fecha){
        $meses = array(enero,febrero,marzo,abril,mayo,junio,julio,agosto,septiembre,octubre,noviembre,diciembre);
        list($fecha,$hora) = explode(" ", $fecha);
        list($ano,$mes,$dia) = explode("-", $fecha);
        return "$dia/".$meses[$mes-1]."/$ano";
    }


?>