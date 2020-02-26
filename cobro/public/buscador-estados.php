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

$sql="SELECT * FROM estados WHERE ".$_GET['criterio']." LIKE '%".$q."%' ORDER BY fecha_siguiente_cobro";
$result = mysqli_query($con,$sql);
$sql2="SELECT * FROM datos";
$resultdato = mysqli_query($con,$sql2);

echo "<table class='tablaBuscador'>
<tr>
<th>Numero Alumno</th>
<th>Fecha a cobrar</th>
<th>Valor cuota</th>
<th>Valor restante</th>
<th>Tarjeta</th>
<th>Boton</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  if (($row['fecha_siguiente_cobro'] != "0000-00-00") && ($row['fecha_siguiente_cobro'] != "1000-01-01")) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['fecha_siguiente_cobro'] . "</td>";
    echo "<td>" . $row['valor_cuota'] . "</td>";
    echo "<td>" . $row['valor_restante'] . "</td>";
    while ($rowdato = mysqli_fetch_array($resultdato)) {
      if ($row['id']==$rowdato['id']) {
        echo "<td>" . $rowdato['tarjeta'] . "</td>";
      }
    }
    echo "<td class='d-flex justify-content-center'><a href='/cobro_id/".$row['id']."'>COBRAR</a></td>";
    echo "</tr>";
  }
    $sql2="SELECT * FROM datos";
    $resultdato = mysqli_query($con,$sql2);
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>
