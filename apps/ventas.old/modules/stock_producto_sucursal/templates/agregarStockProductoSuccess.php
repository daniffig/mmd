<?php use_helper('I18N', 'Date', 'JavascriptBase') ?>
<?php include_partial('stock_producto_sucursal/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Agregar Stock a Producto', array(), 'messages') ?></h1>

  <?php include_partial('stock_producto_sucursal/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('stock_producto_sucursal/form_header', array('StockProductoSucursal' => $StockProductoSucursal, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('stock_producto_sucursal/form'.(method_exists($form, 'getNewLayout') ? '_'.$form->getNewLayout() : ''), array('StockProductoSucursal' => $StockProductoSucursal, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'action' => 'New')) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('stock_producto_sucursal/form_footer', array('StockProductoSucursal' => $StockProductoSucursal, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
