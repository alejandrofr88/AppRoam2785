<?php
include('is_logged.php');
	if (empty($_POST['codigo'])) {
           $errors[] = "Código vacío";
        } else if (empty($_POST['nombre'])){
			$errors[] = "Nombre del producto vacío";
		} else if ($_POST['cantidad']==""){
			$errors[] = "Ingrese la Cantidad del Producto";
		} else if (empty($_POST['precio'])){
			$errors[] = "Precio de venta vacío";
		} else if (
			!empty($_POST['codigo']) &&
			!empty($_POST['nombre']) &&
			!empty($_POST['cantidad']) &&
			!empty($_POST['precio'])
		){
		
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["codigo"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$cantidad=mysqli_real_escape_string($con,(strip_tags($_POST["cantidad"],ENT_QUOTES)));
		$precio_venta=floatval($_POST['precio']);

		if ($cantidad>10){
						 $estado="Disponible";
						}else {
							$estado="AGOTADO";
						}

		$date_added=date("Y-m-d H:i:s");
		$sql="INSERT INTO products (codigo_producto, nombre_producto, cantidad, status_producto, date_added, precio_producto) VALUES ('$codigo','$nombre','$cantidad', '$estado','$date_added','$precio_venta')";
		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Producto ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>