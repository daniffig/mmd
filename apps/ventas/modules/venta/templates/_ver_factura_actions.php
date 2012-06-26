<li class="btn">
  <?php if ($sf_user->hasCredential(array(  0 => 'iniciarVenta',))): ?>
  <?php echo link_to(__('Imprimir Factura', array(), 'messages'), 'venta/imprimirFactura', array()) ?>
<?php endif; ?>
</li>
