<?php
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();

if ($con)
{
	
	$fetch = mysqli_query($con,"SELECT * FROM proveedor where nombre_proveedor like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	
	while ($row = mysqli_fetch_array($fetch)) {
		$id_proveedor=$row['id_proveedor'];
		$row_array['value'] = $row['nombre_proveedor'];
		$row_array['id_proveedor']=$id_proveedor;
		$row_array['nombre_proveedor']=$row['nombre_proveedor'];
		$row_array['telefono_proveedor']=$row['telefono_proveedor'];
		$row_array['email_proveedor']=$row['email_proveedor'];
		array_push($return_arr,$row_array);
    }
	
}


mysqli_close($con);


echo json_encode($return_arr);

}
?>