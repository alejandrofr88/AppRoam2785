<?php
	
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	$active_facturas="";
	$active_compras="active";
	$active_reportes="";
	$active_proveedores="";
	$active_productos="";
	$active_clientes="";
	$active_usuarios="";	
	$title="Nueva Compra | Roam2785";
	
	
	require_once ("config/db.php");
	require_once ("config/conexion.php");
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
			<h4><i class='glyphicon glyphicon-edit'></i> Nueva Compra</h4>
		</div>
		<div class="panel-body">
		<?php 
			include("modal/buscar_productos.php");
			include("modal/registro_proveedores.php");
			include("modal/registro_productos.php");
		?>
			<form class="form-horizontal" role="form" id="datos_compra">
				<div class="form-group row">
				  <label for="nombre_cliente" class="col-md-1 control-label">Proveedor</label>
				  <div class="col-md-3">
					  <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Selecciona un Proveedor" required>
					  <input id="id_cliente" type='hidden'>	
				  </div>
				  <label for="tel1" class="col-md-1 control-label">Teléfono</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
							</div>
					<label for="mail" class="col-md-1 control-label">Email</label>
							<div class="col-md-3">
								<input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly>
							</div>
				 </div>
						<div class="form-group row">
							
							<label for="tel2" class="col-md-1 control-label">Fecha</label>
							<div class="col-md-2">
								<input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
							</div>
							<label for="email" class="col-md-1 control-label">Pago</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="condiciones">
									<option value="1">Efectivo</option>
									<option value="2">Cheque</option>
									<option value="3">Transferencia bancaria</option>
									<option value="4">Crédito</option>
								</select>
							</div>


							<label for="email" class="col-md-1 control-label">Estado</label>
							<div class="col-md-3">
								<select class='form-control input-sm' id="condiciones">
									<option value="1">Pagado</option>
									<option value="2">Por Pagar</option>
			
								</select>
							</div>
						</div>
				
				
				<div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto">
						 <span class="glyphicon glyphicon-plus"></span> Nuevo producto
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProveedor">
						 <span class="glyphicon glyphicon-user"></span> Nuevo Proveedor
						</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
						 <span class="glyphicon glyphicon-search"></span> Agregar productos
						</button>
						<button type="submit" class="btn btn-default">
						  <span class="glyphicon glyphicon-print"></span> Imprimir
						</button>
					</div>	
				</div>
			</form>	
			
		<div id="resultados" class='col-md-12' style="margin-top:10px"></div>		
		</div>
	</div>		
		  <div class="row-fluid">
			<div class="col-md-12">
			
	

			
			</div>	
		 </div>
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="js/nueva_compra.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
		$(function() {
						$("#nombre_proveedor").autocomplete({
							source: "./ajax/autocomplete/proveedor.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#id_proveedor').val(ui.item.id_proveedor);
								$('#nombre_proveedor').val(ui.item.nombre_proveedor);
								$('#tel1').val(ui.item.telefono_proveedor);
								$('#mail').val(ui.item.email_proveedor);
																
								
							 }
						});
						 
						
					});
					
	$("#nombre_proveedor" ).on( "keydown", function( event ) {
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