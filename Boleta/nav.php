<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="contacto.php">Contacto</a></li>
		<?php if($_SESSION[user_id]){?><li><a href="adm/productos.php">Listado Productos</a></li><?php }?>
		<?php if($_SESSION[user_id]){?><li><a href="adm/usuarios.php">Listado Usuarios</a></li><?php }?>
	</ul>
</nav>