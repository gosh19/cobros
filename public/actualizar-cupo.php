<?php

$q = intval($_GET['q']);

$con = mysqli_connect('localhost','asyste3','8e3BGuwo8EH7','asyste3_cobro');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM cupos WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

if($row == ""){
    $sql = "INSERT INTO cupos (id, tiene, created_at, updated_at) VALUES ('".$q."', '".date('Y-m-d')."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
    if(mysqli_query($con, $sql)){
        echo date('Y-m-d');
    }
    else{
        echo "ERROR AL CARGAR";
    }
}
else{
    $sql = "Update cupos Set tiene='".date('Y-m-d')."', updated_at='".date("Y-m-d H:i:s")."' Where id='".$q."'";
    if(mysqli_query($con, $sql)){
        echo date('Y-m-d');
    }
    else{
        echo "ERROR AL ACTUALIZAR";
    }
}

mysqli_close($con);

?>