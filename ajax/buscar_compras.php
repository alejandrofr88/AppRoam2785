<?php

	
	include('is_logged.php');
	
	require_once ("../config/db.php");
	require_once ("../config/conexion.php");
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$numero_factura=intval($_GET['id']);
		$del1="delete from compras where numero_compra='".$numero_compra."'";
		$del2="delete from detalle_compra where numero_compra='".$numero_compra."'";
		if ($delete1=mysqli_query($con,$del1) and $delete2=mysqli_query($con,$del2)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "compras, proveedor, users";
		 $sWhere = "";
		 $sWhere.=" WHERE compras.id_proveedor=proveedor.id_proveedor";
		if ( $_GET['q'] != "" )
		{
		$sWhere.= " and  (proveedor.nombre_proveedor like '%$q%' or proveedor.numero_proveedor like '%$q%')";
			
		}
		
		$sWhere.=" order by proveedor.id_proveedor desc";
		include 'pagination.php'; 
		
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './compras.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>#</th>
					<th>Fecha</th>
					<th>Proveedor</th>
					<th class='text-right'>Total</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_compra=$row['id_compra'];
						$numero_compra=$row['numero_compra'];
						$fecha=date("d/m/Y", strtotime($row['fecha_compra']));
						$nombre_proveedor=$row['nombre_proveedor'];
						$telefono_proveedor=$row['telefono_proveedor'];
						$email_proveedor=$row['email_proveedor'];
						
						$estado_compra=$row['estado_compra'];
						if ($estado_compra==1){
							$text_estado="Pagada";
							$label_class='label-success';
						}
						else{
							$text_estado="Por Pagar";
							$label_class='label-warning';
						}
						
						$total_compra=$row['total_compra'];
					?>
					<tr>
						<td><?php echo $numero_compra; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><a href="#" data-toggle="tooltip" data-placement="top" title="<i class='glyphicon glyphicon-phone'></i> <?php echo $telefono_proveedor;?><br><i class='glyphicon glyphicon-envelope'></i>  <?php echo $email_proveedor;?>" ><?php echo $nombre_proveedor;?></a></td>
						<td><?php echo $nombre_proveedor; ?></td>
						<td><span class="label <?php echo $label_class;?>"><?php echo $text_estado; ?></span></td>
						<td class='text-right'><?php echo number_format ($total_compra,2); ?></td>					
					<td class="text-right">
						<a href="editar_compra.php?id_compra=<?php echo $id_compra;?>" class='btn btn-default' title='Editar Compra' ><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Descargar compra' onclick="imprimir_factura('<?php echo $id_compra;?>');"><i class="glyphicon glyphicon-download"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar compra' onclick="eliminar('<?php echo $numero_compra; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>