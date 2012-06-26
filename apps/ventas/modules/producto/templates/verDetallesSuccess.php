<?php use_helper('I18N', 'Date') ?>
<?php use_stylesheet('mostrarProducto.css') ?>

<div id="sf_admin_container">
  <h1><?php echo $Producto . ' (' . $Producto->getTipoProducto() . ')'; ?></h1>
  
  <div id="datos">
    <br/>
    <p class="resaltado"><strong>Precio: </strong><?php echo $Producto->getPrecioFormateado(); ?></p>
    <br/>
    <p class="resaltado"><strong>Stock: </strong><?php echo $Producto->getCantidadStockEnMiSucursal(); ?></p>
    <br/>
    <p><strong>Diponibilidad en otras sucursales:</strong></p>
    <?php if (count($StockProductoOtrasSucursales) > 0): ?>
    <?php foreach ($StockProductoOtrasSucursales as $StockProductoSucursal): ?>
       <p>&nbsp;&nbsp;<?php echo $StockProductoSucursal->getSucursal(); ?>: <?php echo $StockProductoSucursal->getCantidad(); ?></p>
    <?php endforeach; ?>
    <?php else: ?>
       <p>&nbsp;&nbsp;Sin disponibilidad.</p>
    <?php endif; ?>
  </div>

  <div id="imagen">
    <img src="<?php echo $Producto->getImagenCompleta(); ?>" width="320" height="240" />
  </div>
  <div style="clear:both"></div>
  <h3>Descripci&oacute;n</h3>
  <p><?php echo $Producto->getDescripcion(); ?></p>
  
</div>

