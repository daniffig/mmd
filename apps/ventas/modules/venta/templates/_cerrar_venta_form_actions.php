<ul class="sf_admin_actions">
<?php if ($form->isNew()): ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Cerrar Venta',  'params' =>   array(  ),  'class_suffix' => 'save',)) ?>
<?php else: ?>
  <?php echo $helper->linkToSave($form->getObject(), array(  'label' => 'Cerrar Venta',  'params' =>   array(  ),  'class_suffix' => 'save',)) ?>
<?php endif ?>
</ul>
