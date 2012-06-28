<?php use_stylesheet('productosConBajoStock.css') ?>
<div id="container">
  <div id="header">
    <h2 style="font-family:sans-serif,Loma; color:green; float:left">ElectroHogar s.a.</h2>
    <?php echo image_tag('electrohogar_banner.png'); ?>
    <p style="float:right">Fecha: <?php echo date('d/m/Y', time()); ?></p>
    <hr style="clear:both" class="divider-footer" />
    
    <h3>Reporte de Productos debajo del stock minimo</h3>
  <?php if (count($StockMinimoProductosSucursal) > 0): ?>
    <table class="datosProductos">
      <tr>
      <?php if ($sf_user->hasCredential('reportarStockMinimoTodos')): ?>
        <th style="background-color:#e7eef6; padding:3px 10px;" >Sucursal</th>
      <?php endif; ?>
        <th style="background-color:#e7eef6; padding:3px 10px;">Tipo</th>
        <th style="background-color:#e7eef6; padding:3px 10px;">Marca</th>
	      <th style="background-color:#e7eef6; padding:3px 10px;">Modelo</th>
	      <th style="background-color:#e7eef6; padding:3px 10px;">Stock Actual</th>
      </tr>
    <!--Esto dentro de un foreach obviamente-->
  
  <?php foreach($StockMinimoProductosSucursal as $StockMinimoProductoSucursal): ?>
  <?php $Producto = $StockMinimoProductoSucursal->getProducto(); ?>
      <tr>
      <?php if ($sf_user->hasCredential('reportarStockMinimoTodos')): ?>
        <td align="center" style="border-bottom:1px solid #ccc; padding:3px 10px;"><?php echo $StockMinimoProductoSucursal->getSucursal(); ?></td>
      <?php endif; ?>
        <td align="center" style="border-bottom:1px solid #ccc; padding:3px 10px;"><?php echo $Producto->getTipoProducto(); ?></td>
        <td align="center" style="border-bottom:1px solid #ccc; padding:3px 10px;"><?php echo $Producto->getMarca(); ?></td>
        <td align="center" style="border-bottom:1px solid #ccc; padding:3px 10px;"><?php echo $Producto->getModelo(); ?></td>
	<td align="center" style="border-bottom:1px solid #ccc; padding:3px 10px;"><?php echo $StockMinimoProductoSucursal->getCantidad(); ?></td>
      </tr>
  <?php endforeach; ?>
  <?php else: ?>
    <tr>
      <td>Sin resultados.</td>
    </tr>
  <?php endif; ?>
    </table>
  </div>
</div> 
