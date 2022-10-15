<?php

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$td = $_POST['Tipodocumento'];
$nd = $_POST['numerodocumento'];
$email = $_POST['email'];
$telefono = $_POST['numerotelefono'];

if(!empty($nombre) || !empty($apellido) || !empty($td) || !empty($nd) || !empty($email) || !empty($telefono)){
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "formulario";    

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(mysqli_connect_error()){
        die('Connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }

    else{
         $SELECT = "SELECT nd from clientes where nd = ? limit 1";
         $INSERT = "INSERT INTO cliente (nombre,apellido,td,nd,email,telefono) values (?,?,?,?,?,?)"
    
         $stmt = $conn ->prepare($SELECT);
         $stmt ->bind_param("i",$nd);   
         $stmt ->execute();
         $stmt ->bind_result($nd);
         $stmt ->store_result();
         $rnum ->$stmt->num_rows;
         if($rnum == 0){

            $stmt ->close();
            $stmt = $conn->prepare($INSERT);
            $stmt ->bind_param("sssisi", $nombre,$apellido,$td,$nd,$email,$telefono);
            $stmt ->execute();
            echo "¡¡REGISTRO EXITOSO!!";
        }
        else {
            echo "Numero de identificacion ya esta registrado.";

        }    
        $stmt->close();
        $conn->close();
    }

}
else{
    echo "Ingresa todos los datos";
    die();
}

?>