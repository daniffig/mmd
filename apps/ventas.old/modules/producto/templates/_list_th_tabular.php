<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_imagen_thumb">
  <?php echo __('', array(), 'messages') ?>
</th>
<?php end_slot() ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_marca">
  <?php echo __('Marca', array(), 'messages') ?>
</th>
<?php end_slot() ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_modelo">

  <?php if ($configuration->getIsMultipleSort()): ?>
    <?php if (isset($sort['modelo']) ): ?>
      <?php echo link_to(__('Modelo', array(), 'messages'), '@producto', array('query_string' => 'sort=modelo&sort_type='.($sort['modelo'][1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort['modelo'][1].'.png', array('alt' => __($sort['modelo'][1], array(), 'sf_admin'), 'title' => __($sort['modelo'][1], array(), 'sf_admin'))) ?>
      <?php $clean_icon = image_tag('/pmPropelGeneratorPlugin/images/delete.png', array('alt' => __('Clean', array(), 'sf_admin'), 'title' => __('Clean sort criteria', array(), 'sf_admin'))) ?>
      <?php echo link_to($clean_icon, '@producto', array('query_string' => 'sort=modelo&sort_type=clean')) ?>

    <?php else: ?>
      <?php echo link_to(__('Modelo', array(), 'messages'), '@producto', array('query_string' => 'sort=modelo&sort_type=asc')) ?>
    <?php endif ?>
  <?php else: ?>
    <?php if ('modelo' == $sort[0]): ?>
      <?php echo link_to(__('Modelo', array(), 'messages'), '@producto', array('query_string' => 'sort=modelo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Modelo', array(), 'messages'), '@producto', array('query_string' => 'sort=modelo&sort_type=asc')) ?>
    <?php endif ?>
  <?php endif ?>
</th>
<?php end_slot() ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_precio">

  <?php if ($configuration->getIsMultipleSort()): ?>
    <?php if (isset($sort['precio']) ): ?>
      <?php echo link_to(__('Precio', array(), 'messages'), '@producto', array('query_string' => 'sort=precio&sort_type='.($sort['precio'][1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort['precio'][1].'.png', array('alt' => __($sort['precio'][1], array(), 'sf_admin'), 'title' => __($sort['precio'][1], array(), 'sf_admin'))) ?>
      <?php $clean_icon = image_tag('/pmPropelGeneratorPlugin/images/delete.png', array('alt' => __('Clean', array(), 'sf_admin'), 'title' => __('Clean sort criteria', array(), 'sf_admin'))) ?>
      <?php echo link_to($clean_icon, '@producto', array('query_string' => 'sort=precio&sort_type=clean')) ?>

    <?php else: ?>
      <?php echo link_to(__('Precio', array(), 'messages'), '@producto', array('query_string' => 'sort=precio&sort_type=asc')) ?>
    <?php endif ?>
  <?php else: ?>
    <?php if ('precio' == $sort[0]): ?>
      <?php echo link_to(__('Precio', array(), 'messages'), '@producto', array('query_string' => 'sort=precio&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Precio', array(), 'messages'), '@producto', array('query_string' => 'sort=precio&sort_type=asc')) ?>
    <?php endif ?>
  <?php endif ?>
</th>
<?php end_slot() ?>

<?php if (false): ?>
<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_boolean sf_admin_list_th_es_activo">

  <?php if ($configuration->getIsMultipleSort()): ?>
    <?php if (isset($sort['es_activo']) ): ?>
      <?php echo link_to(__('Activo', array(), 'messages'), '@producto', array('query_string' => 'sort=es_activo&sort_type='.($sort['es_activo'][1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort['es_activo'][1].'.png', array('alt' => __($sort['es_activo'][1], array(), 'sf_admin'), 'title' => __($sort['es_activo'][1], array(), 'sf_admin'))) ?>
      <?php $clean_icon = image_tag('/pmPropelGeneratorPlugin/images/delete.png', array('alt' => __('Clean', array(), 'sf_admin'), 'title' => __('Clean sort criteria', array(), 'sf_admin'))) ?>
      <?php echo link_to($clean_icon, '@producto', array('query_string' => 'sort=es_activo&sort_type=clean')) ?>

    <?php else: ?>
      <?php echo link_to(__('Activo', array(), 'messages'), '@producto', array('query_string' => 'sort=es_activo&sort_type=asc')) ?>
    <?php endif ?>
  <?php else: ?>
    <?php if ('es_activo' == $sort[0]): ?>
      <?php echo link_to(__('Activo', array(), 'messages'), '@producto', array('query_string' => 'sort=es_activo&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
      <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
    <?php else: ?>
      <?php echo link_to(__('Activo', array(), 'messages'), '@producto', array('query_string' => 'sort=es_activo&sort_type=asc')) ?>
    <?php endif ?>
  <?php endif ?>
</th>
<?php end_slot() ?>
<?php endif; ?>
<?php include_slot('sf_admin.current_header') ?>
