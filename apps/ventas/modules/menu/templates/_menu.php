<div class="navbar navbar-fixed-top">
  
  <div class="navbar-inner">
    <div class="container" style="width: auto;">
      
      <div class="nav-collapse">
        <?php echo image_tag('electrohogar_icon.png','style=float:left;margin:0px 10px 2px'); ?>
        <?php  echo link_to(__('MMD'), '@producto', array('class' => 'brand')); ?>
        
        <ul class="nav">
         
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Productos<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Productos</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Productos"), '@producto'); ?></li>
              <?php if ($sf_user->hasCredential('agregarProducto')): ?>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Producto"), '@producto_new'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrarMarcas')): ?>
              <li class="divider"></li>
              <li class="nav-header">Stock</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Stock"), '@stock_producto_sucursal'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Stock"), '@stock_producto_sucursal_new'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrarMarcas')): ?>
              <li class="divider"></li>
              <li class="nav-header">Marcas</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Marcas"), '@marca'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Marca"), '@marca_new'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrarCategorias')): ?>
              <li class="divider"></li>
              <li class="nav-header">Categorías</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Categorías"), '@categoria'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Categoría"), '@categoria_new'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrarTiposProducto')): ?>
              <li class="divider"></li>
              <li class="nav-header">Tipos de Producto</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Tipos de Producto"), '@tipo_producto'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Tipo de Producto"), '@tipo_producto_new'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('administrarCaracteristicas')): ?>
              <li class="divider"></li>
              <li class="nav-header">Características</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Características"), '@caracteristica'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Característica"), '@caracteristica_new'); ?></li>
              <?php endif; ?>
            </ul>
          </li>
         
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Ventas<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Ventas</li>
              <?php /* ?>
              <?php if ($sf_user->hasCredential('verMisVentas')): ?>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Mis Ventas"), 'venta/verMisVentas'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Mis Ventas Activas"), 'venta/verMisVentasActivas'); ?></li>
              <?php endif; ?>
              <?php */ ?>
              <?php if ($sf_user->hasCredential('verVentas')): ?>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Ventas"), '@venta'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('gestionarVentas')): ?>
              <li class="divider"></li>
              <li class="nav-header">Venta Activa</li>
              <?php if (!$sf_user->tieneVenta()): ?>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Iniciar Venta"), 'venta/iniciarVenta'); ?></li>
              <?php else: ?>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Ver Venta Activa"), 'producto_venta/verVentaActiva'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Cerrar Venta"), 'venta/cerrarVenta'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Cancelar Venta"), 'venta/cancelarVenta'); ?></li>
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
              <?php if ($sf_user->hasCredential('administrarTiposDocumento')): ?>
              <li class="divider"></li>
              <li class="nav-header">Tipos de Documento</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Tipos de Documento"), '@tipo_documento'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Tipo de Documento"), '@tipo_documento_new'); ?></li>
              <?php endif; ?>
            </ul>
          </li>

          <?php if ($sf_user->hasCredential('administrarUsuarios')): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Usuarios</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Usuarios"), '@sf_guard_user'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Usuario"), '@sf_guard_user_new'); ?></li>
              <li class="divider"></li>
              <li class="nav-header">Grupos</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Grupos"), '@sf_guard_group'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Grupo"), '@sf_guard_group_new'); ?></li>
              <li class="divider"></li>
              <li class="nav-header">Permisos</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Permisos"), '@sf_guard_permission'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Permiso"), '@sf_guard_permission_new'); ?></li>
            </ul>
          </li>
          <?php endif; ?>

          <?php if ($sf_user->hasCredential('administrarSistema')): ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Sucursales</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Sucursales"), '@sucursal'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Sucursal"), '@sucursal_new'); ?></li>
              <li class="divider"></li>
              <li class="nav-header">Preferencias</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Preferencias"), '@preferencia'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Preferencia"), '@preferencia_new'); ?></li>
            </ul>
          </li>
          <?php endif; ?>
          
        </ul>
     
        <ul class="nav pull-right">
          <li id="fat-menu" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php    echo $sf_user->getUsername();  ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><?php  echo link_to(__("<i class='icon-off'></i> Salir"), '@sf_guard_signout'); ?></li>
            </ul>
          </li>
        </ul>
        
      </div>
    </div>
  </div>  
</div> 
