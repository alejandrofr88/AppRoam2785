<?php
	include('is_logged.php');
	if (empty($_POST['mod_id'])) {
						           $errors[] = "ID vacío";

						        } 
						        else if (empty($_POST['mod_codigo'])) {
						           $errors[] = "Código vacío";
						        } 
						        else if (empty($_POST['mod_nombre'])){
									$errors[] = "Nombre del producto vacío";
								} 
								else if (empty($_POST['mod_cantidad'])){
									$errors[] = "mardita sea la verga esta pss";
								} 
								else if (empty($_POST['mod_precio'])){
									$errors[] = "Precio de venta vacío";
								} 
								else if (
										!empty($_POST['mod_id']) &&
										!empty($_POST['mod_codigo']) &&
										!empty($_POST['mod_nombre']) &&
										!empty($_POST['mod_cantidad']) &&
										!empty($_POST['mod_precio'])
		){
		
		require_once ("../config/db.php");
		require_once ("../config/conexion.php");
		
		$codigo=mysqli_real_escape_string($con,(strip_tags($_POST["mod_codigo"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($con,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$cantidad=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cantidad"],ENT_QUOTES)));
		$precio_venta=floatval($_POST['mod_precio']);
		$id_producto=$_POST['mod_id'];

						
						$sql= "SELECT * FROM products";
					     $res = mysqli_query($con,$sql); 
					     while ($row = mysqli_fetch_row($res)){      
					                                             $a=$row[0];
						                                         $b=$row[1];
						                                         $c=$row[2];
						                                         $d=$row[3];
						                                         $e=$row[4];
						                                         $f=$row[5];
						                                         $g=$row[6];
					                                           }

					                                           $cantidad+=$d;

					                                           if ($cantidad>10){
																				 $estado="Disponible";
																				}else {
																					$estado="AGOTADO";
																						}

		$sql="UPDATE products SET codigo_producto='".$codigo."', nombre_producto='".$nombre."', cantidad='".$cantidad."', status_producto='".$estado."', precio_producto='".$precio_venta."' WHERE id_producto='".$id_producto."'";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
								$messages[] = "Producto ha sido actualizado satisfactoriamente.";
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