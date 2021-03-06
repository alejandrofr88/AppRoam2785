<?php
	include('is_logged.php');
	$id_factura= $_SESSION['id_factura'];
	
	if (empty($_POST['id_cliente'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['condiciones'])){
			$errors[] = "Selecciona forma de pago";
		} else if ($_POST['estado_compra']==""){
			$errors[] = "Selecciona el estado de la compra";
		} else if (
			!empty($_POST['id_proveedor']) &&
			!empty($_POST['condiciones']) &&
			$_POST['estado_compra']!="" 
		){
		
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		
		$id_proveedor=intval($_POST['id_proveedor']);
		$condiciones=intval($_POST['condiciones']);

		$estado_compra=intval($_POST['estado_compra']);
		
		$sql="UPDATE compras SET id_proveedor='".$id_proveedor."', condiciones='".$condiciones."', estado_compra='".$estado_compra."' WHERE id_compra='".$id_compra."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "Compra ha sido actualizada satisfactoriamente.";
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