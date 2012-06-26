<li class="btn">
  <?php if ($sf_user->hasCredential(array(  0 => 'iniciarVenta',))): ?>
  <?php echo link_to(__('Imprimir Factura', array(), 'messages'), 'factura_imprimir_factura', array('venta_id' => $venta->getId())) ?>
<?php endif; ?>
</li>
