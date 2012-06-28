<?php use_helper('I18N', 'Date') ?>
<?php include_partial('venta/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Cerrar Venta', array(), 'messages') ?></h1>

  <?php include_partial('venta/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('venta/form_header', array('Venta' => $Venta, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('venta/cerrar_venta_form'.(method_exists($form, 'getNewLayout') ? '_'.$form->getNewLayout() : ''), array('Venta' => $Venta, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper, 'action' => 'New')) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('venta/form_footer', array('Venta' => $Venta, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
