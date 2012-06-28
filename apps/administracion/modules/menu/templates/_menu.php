<div class="navbar navbar-fixed-top">
  
  <div class="navbar-inner">
    <div class="container" style="width: auto;">
      
      <div class="nav-collapse">
        <?php echo image_tag('electrohogar_icon.png','style=float:left;margin:0px 10px 2px'); ?>
        <?php  echo link_to(__('MMD'), '@producto', array('class' => 'brand')); ?>
        <ul class="nav">
         

          <!--- Productos --->
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
              <li><?php  //echo link_to(__("<i class='icon-file'></i> Reportar Stock Mínimo"), 'stock_producto_sucursal_reportar_stock_minimo', array('sf_format' => 'pdf') ); ?></li>
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
            </ul>
          </li>

          <!--- Clientes --->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Clientes</li>
              <?php if ($sf_user->hasCredential('verClientes')): ?>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Clientes"), '@cliente'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('agregarCliente')): ?>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Cliente"), '@cliente_new'); ?></li>
              <?php endif; ?>
            </ul>
          </li>

          <!--- Empleados --->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Empleados<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Empleados</li>
              <?php if ($sf_user->hasCredential('verEmpleados')): ?>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Empleados"), '@sf_guard_user'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('agregarEmpleado')): ?>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Empleado"), '@sf_guard_user_new'); ?></li>
              <?php endif; ?>
            </ul>
          </li>

          <!--- Usuarios --->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Usuarios</li>
              <?php if ($sf_user->hasCredential('verUsuarios')): ?>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Usuarios"), '@sf_guard_user'); ?></li>
              <?php endif; ?>
              <?php if ($sf_user->hasCredential('agregarUsuario')): ?>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Usuario"), '@sf_guard_user_new'); ?></li>
              <?php endif; ?>
            </ul>
          </li>
          
        </ul>
     
        <ul class="nav pull-right">
          <li id="fat-menu" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php    echo $sf_user->getUsername();  ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
              <li><?php  echo link_to(__("<i class='icon-user'></i> Mi Perfil"), 'sf_guard_user_edit', array('id' => $sf_user->getGuardUser()->getId())); ?></li>
              <li><?php  echo link_to(__("<i class='icon-off'></i> Salir"), '@sf_guard_signout', array('confirm' => '¿Salir del sistema?' )); ?></li>
            </ul>
          </li>
        </ul>
        
      </div>
    </div>
  </div>  
</div> 
