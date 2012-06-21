<?php use_helper('I18N', 'Date') ?>
<?php include_partial('venta/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Detalles del Producto :: ' . $Producto->getMarca() . ' ' . $Producto->getModelo(), array(), 'messages') ?></h1>
 
  <?php include_partial('venta/flashes') ?>

  <div id="sf_admin_header">
    <?php // include_partial('venta/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('producto/detalles', array('producto' => $Producto)) ?>
  </div>

  <div id="sf_admin_footer">
      <?php include_partial('producto/ver_detalles_actions', array('helper' => $helper)) ?>
  </div>
</div>
