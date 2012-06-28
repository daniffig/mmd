<li class="sf_admin_action_iniciar_venta">
  <?php if ($sf_user->hasCredential(array(  0 => 'iniciarVenta',))): ?>
<?php echo link_to(__('Listar', array(), 'messages'), '@producto', array()) ?>
<?php endif; ?>

</li>
