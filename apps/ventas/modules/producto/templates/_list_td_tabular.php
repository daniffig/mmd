<td class="sf_admin_text sf_admin_list_td_imagen_thumb">
  <?php echo get_partial('producto/imagen_thumb', array('type' => 'list', 'Producto' => $Producto)) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_marca">
  <?php echo $Producto->getMarca() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modelo">
  <?php echo $Producto->getModelo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_precio">
  <?php echo get_partial('producto/precio', array('type' => 'list', 'Producto' => $Producto)) ?>
</td>
<?php if (false): //($sf_user->hasCredential('administrarProductos')): ?>
<td class="sf_admin_boolean sf_admin_list_td_es_activo">
  <?php echo get_partial('producto/list_field_boolean', array('value' => $Producto->getEsActivo())) ?>
<?php endif; ?>
</td>
