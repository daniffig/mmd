<div class="navbar navbar-fixed-top">
  
  <div class="navbar-inner">
    <div class="container" style="width: auto;">
      
      <div class="nav-collapse">
        <?php echo image_tag('electrohogar_icon.png','style=float:left;margin:0px 10px 2px'); ?>
        <?php  echo link_to(__('MMD'), '@homepage', array('class' => 'brand')); ?>
        <ul class="nav">
         
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Productos</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Productos"), '@producto'); ?></li>
            </ul>
          </li>
         
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Ventas</li>
              <?php if ($sf_user->hasCredential('verVentas')): ?>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Mis Ventas"), 'venta/verVentas'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('gestionarVentas')): ?>
              <li class="divider"></li>
              <li class="nav-header">Venta Activa</li>
              <?php if (!$sf_user->tieneVenta()): ?>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Iniciar Venta"), 'venta/iniciarVenta'); ?></li>
              <?php else: ?>
              <li><?php  echo link_to(__("<i class='icon-shopping-cart'></i> Ver Venta Activa"), '@producto_venta'); ?></li>
              <?php if ($sf_user->getVenta()->tieneProductos()): ?>
              <li><?php  echo link_to(__("<i class='icon-check'></i> Cerrar Venta"), 'venta/cerrarVenta'); ?></li>
              <?php endif; ?>
              <li><?php  echo link_to(__("<i class='icon-remove'></i> Cancelar Venta"), 'venta/cancelarVenta', array('confirm' => '¿Está seguro que desea cancelar la Venta Activa?')); ?></li>
              <?php endif; ?>
              <?php endif; ?>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Clientes</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Clientes"), '@cliente'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Cliente"), '@cliente_new'); ?></li>
            </ul>
          </li>
          
        </ul>
     
        <ul class="nav pull-right">
          <li id="fat-menu" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $sf_user->getUsername(); ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><?php echo link_to(__("<i class='icon-user'></i> Mi Perfil"), '@usuario_ver_mi_perfil'); ?></li>
              <li><?php echo link_to(__("<i class='icon-off'></i> Salir"), '@sf_guard_signout', array('confirm' => '¿Salir del sistema?' )); ?></li>
            </ul>
          </li>
        </ul>
        
      </div>
    </div>
  </div>  
</div> 
