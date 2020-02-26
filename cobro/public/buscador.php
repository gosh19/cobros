<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','asyste3','8e3BGuwo8EH7','asyste3_cobro');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM datos WHERE id LIKE '".$q."%'";
$result = mysqli_query($con,$sql);

echo "<table class='tablaBuscador'>
<tr>
<th>Numero Alumno</th>
<th>Nombre</th>
<th>DNI</th>
<th>E-mail</th>
<th>Datos Tarjeta</th>
<th>Editar</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td>" . $row['dni'] . "</td>";
    echo "<td>" . $row['mail'] . "</td>";
    echo "<td>" . $row['tarjeta'] . "</td>";
    echo "<td><a href='/editar/" . $row['id'] . "'>EDITAR</a></td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
