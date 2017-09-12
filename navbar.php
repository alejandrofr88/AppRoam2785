	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Roam2785</a>
    </div>

    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php echo $active_facturas;?>"><a href="facturas.php"><i class='glyphicon glyphicon-list-alt'></i> Facturas <span class="sr-only">(current)</span></a></li>

        <li class="<?php echo $active_compras;?>"><a href="compras.php"><i class='glyphicon glyphicon-list-alt'></i> Compras</a></li>

        <li class="<?php echo $active_productos;?>"><a href="          "><i class='glyphicon glyphicon-barcode'></i> Reportes</a></li>

        <li class="<?php echo $active_proveedores;?>"><a href="proveedores.php"><i class='glyphicon glyphicon-user'></i> Proveedores</a></li>

        <li class="<?php echo $active_productos;?>"><a href="productos.php"><i class='glyphicon glyphicon-barcode'></i> Productos</a></li>
        


		<li class="<?php echo $active_clientes;?>"><a href="clientes.php"><i class='glyphicon glyphicon-user'></i> Clientes</a></li>

		<li class="<?php echo $active_usuarios;?>"><a href="usuarios.php"><i  class='glyphicon glyphicon-lock'></i> Usuarios</a></li>
		
       </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://obedalvarado.pw/contacto/" target='_blank'><i class='glyphicon glyphicon-envelope'></i> Soporte</a></li>
		<li><a href="login.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
      </ul>
    </div>
  </div>
</nav>
	<?php
		}
	?>