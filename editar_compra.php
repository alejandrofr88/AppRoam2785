<?php
	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_facturas="";
	$active_compras="active";
	$active_reportes="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";
	$title="Editar Compra | Roam2785";
	
	
	require_once ("config/db.php");
	require_once ("config/conexion.php");
	
	if (isset($_GET['id_compra']))
	{
		$id_factura=intval($_GET['id_compra']);
		$campos="proveedor.id_proveedor, proveedor.nombre_proveedor, proveedor.telefono_proveedor, proveedor.email_proveedor, compras.fecha_compra, compras.condiciones, compras.estado_compra, compras.numero_compra";
		$sql_compra=mysqli_query($con,"select $campos from compras, proveedor where compras.id_proveedore=proveedor.id_proveedor and id_compra='".$id_compra."'");
		$count=mysqli_num_rows($sql_compra);
		if ($count==1)
		{
				$rw_compra=mysqli_fetch_array($sql_compra);
				$id_proveedor=$rw_factura['id_proveedor'];
				$nombre_proveedor=$rw_compra['nombre_proveedor'];
				$telefono_proveedor=$rw_compra['telefono_proveedor'];
				$email_proveedor=$rw_compra['email_proveedor'];
				$fecha_compra=date("d/m/Y", strtotime($rw_factura['fecha_compra']));
				$condiciones=$rw_compra['condiciones'];
				$estado_compra=$rw_compra['estado_compra'];
				$numero_compra=$rw_compra['numero_compra'];
				$_SESSION['id_compra']=$id_compra;
				$_SESSION['numero_compra']=$numero_compra;
		}	
		else
		{
			header("location: compras.php");
			exit;	
		}
	} 
	else 
	{
		header("location: compras.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>  
    <div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-edit'></i> Editar Compra</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_proveedor.php");
			include("modal/registro_productos.php");
		?>
			<form class="form-horizontal" role="form" id="datos_compra">
				<div class="form-group row">
				  <label for="nombre_proveedor" class="col-md-1 control-label"> Proveedor</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_proveedor" placeholder="Selecciona un proveedor" required value="<?php echo $nombre_proveedor;?>">
					  <input id="id_proveedor" name="id_proveedor" type='hidden' value="<?php echo $id_cliente;?>">	
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Teléfono</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" value="<?php echo $telefono_proveedor;?>" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly value="<?php echo $email_cliente;?>">
							</div>
				 </div>
						<div class="form-group row">
							
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo $fecha_compra;?>" readonly>
							</div>
							<label for="email" class="col-md-1 control-label"> Pago</label>
							<div class="col-md-2">
								<select class='form-control input-sm ' id="condiciones" name="condiciones">
									<option value="1" <?php if ($condiciones==1){echo "selected";}?>>Efectivo</option>
									<option value="2" <?php if ($condiciones==2){echo "selected";}?>>Cheque</option>
									<option value="3" <?php if ($condiciones==3){echo "selected";}?>>Transferencia bancaria</option>
									<option value="4" <?php if ($condiciones==4){echo "selected";}?>>Crédito</option>
								</select>
							</div>
							<div class="col-md-2">
								<select class='form-control input-sm ' id="estado_factura" name="estado_factura">
									<option value="1" <?php if ($estado_compra==1){echo "selected";}?>>Pagado</option>
									<option value="2" <?php if ($estado_compra==2){echo "selected";}?>>Por Pagar</option>
								
								</select>
							</div>
						</div>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-refresh"></span> Actualizar datos
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto">
						 <span class="glyphicon glyphicon-plus"></span> Nuevo producto
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProveedor">
						 <span class="glyphicon glyphicon-user"></span> Nuevo proveedor
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
						<button type="button" class="btn btn-default" onclick="imprimir_compra('<?php echo $id_compra;?>')">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
			</form>	
			<div class="clearfix"></div>
				<div class="editar_compra" class='col-md-12' style="margin-top:10px"></div>	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div>		
			
		</div>
	</div>		
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/editar_compra.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#nombre_proveedor").autocomplete({
							source: "./ajax/autocomplete/proveedor.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_proveedor').val(ui.item.id_cliente);
								$('#nombre_proveedor').val(ui.item.nombre_proveedor);
								$('#tel1').val(ui.item.telefono_proveedor);
								$('#mail').val(ui.item.email_proveedor);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_cliente" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#id_proveedor" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre_proveedor" ).val("");
							$("#id_proveedor" ).val("");
							$("#tel1" ).val("");
							$("#mail" ).val("");
						}
			});	
	</script>

  </body>
</html>