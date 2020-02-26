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

$sql="SELECT * FROM cobros WHERE ".$_GET['criterio']." LIKE '%".$q."%'";
$result = mysqli_query($con,$sql);

echo "<table class='tablaBuscador'>
<tr>
  <th>Numero Alumno</th>
  <th>Numero Operacion</th>
  <th>Tipo</th>
  <th>Cantidad cuotas</th>
  <th>Monto</th>
  <th>Cuenta</th>
  <th>Fecha</th>
  <th>Editar</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['numero_operacion'] . "</td>";
    echo "<td>" . $row['tipo'] . "</td>";
    echo "<td>" . $row['cant_cuotas'] . "</td>";
    echo "<td>" . $row['monto'] . "</td>";
    echo "<td>" . $row['cuenta'] . "</td>";
    echo "<td>" . $row['fecha'] . "</td>";
    echo "<td class='d-flex justify-content-center'><a href='/editar-cobro/".$row['id']."'>EDITAR</a></td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
