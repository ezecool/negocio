




<div id="menu">
   <nav>
      <ul>
         <li><a href="index.php">Inicio</a></li>
         <?php if($_SESSION['nivel'] != 0) { ?>
            <li><a href="index.php?accion=productos">Productos</a></li>
            <li><a href="index.php?accion=marcas">Marcas</a></li>
            <li><a href="index.php?accion=proveedores">Proveedores</a></li>
            <li><a href="">Rubros</a></li>
            <li><a href="">Categorias</a></li>
         <?php } ?>
         <li><a href="index.php?accion=comprar">Comprar</a></li>
         <li><a href="index.php?accion=carrito">Ver carrito</a></li>
         <li><a href="index.php?accion=logout">Desconectar</a></li>
      </ul>
   </nav>
</div>