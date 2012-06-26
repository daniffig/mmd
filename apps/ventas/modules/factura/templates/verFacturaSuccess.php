<?php use_helper('I18N', 'Date') ?>
<?php include_partial('factura/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Ver Factura', array(), 'messages') ?></h1>

  <?php include_partial('factura/flashes') ?>

  <div id="sf_admin_content">
    <?php include_partial('factura/factura', array('factura' => $Factura, 'venta' => $Venta, 'productos_venta' => $ProductoVentas, 'cliente' => $Cliente, 'sucursal' => $Sucursal)) ?>
  </div>

  <div id="sf_admin_footer"><?php include_partial('factura/ver_factura_actions', array('venta' => $Venta, 'helper' => $helper)) ?>
  </div>
</div>
