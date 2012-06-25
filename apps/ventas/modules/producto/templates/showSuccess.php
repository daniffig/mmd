<?php use_helper('I18N', 'Date') ?>
<?php include_partial('venta/assets') ?>
<?php use_stylesheet('mostrarProducto.css') ?>

<div id="sf_admin_container">
  <h1><?php echo $Producto . ' (' . $Producto->getTipoProducto() . ')'; ?></h1>
  
  <div id="datos">
    <br/>
    <p class="resaltado"><strong>Precio: </strong><?php echo $Producto->getPrecio(); ?> $</p>
    <br/>
    <p class="resaltado"><strong>Stock: </strong>elStock</p>
    <br/>
    <p><strong>Diponibilidad en otras sucursales:</strong></p>
       <p>&nbsp;&nbsp;unaSucursal1: unStock1</p>
       <p>&nbsp;&nbsp;unaSucursal2: unStock2</p>   
  </div>

  <div id="imagen">
    <img src="<?php echo $Producto->getImagenCompleta(); ?>" width="320" height="240" />
  </div>
  <div style="clear:both"></div>
  <h3>Descripci&oacute;n</h3>
  <p><?php echo $Producto->getDescripcion(); ?></p>
  
</div>

