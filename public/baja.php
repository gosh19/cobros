<?php

$con = mysqli_connect('localhost','root','','cobro');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql = "INSERT INTO xd (id, asd)
VALUES (1, 2)";
 ?>
