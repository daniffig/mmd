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
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Producto"), '@producto_new'); ?></li>
              <li class="divider"></li>
              <li class="nav-header">Marcas</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Marcas"), '@marca'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Marca"), '@marca_new'); ?></li>
              <li class="divider"></li>
              <li class="nav-header">Tipos</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Tipos"), '@tipo'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Tipo"), '@tipo_new'); ?></li>
              <li class="divider"></li>
              <li class="nav-header">Características</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Características"), '@caracteristica'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Característica"), '@caracteristica_new'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Ver Asociaciones a Producto"), '@caracteristica_producto'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Asociar a Producto"), '@caracteristica_producto_new'); ?></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administración<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Usuarios</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Usuarios"), '@sf_guard_user'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Usuario"), '@sf_guard_user_new'); ?></li>
              <li class="divider"></li>
              <li class="nav-header">Sucursales</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Ver Sucursales"), '@sucursal'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Agregar Sucursal"), '@sucursal_new'); ?></li>
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
              <li><?php  echo link_to(__("<i class='icon-off'></i> Salir"), '@sf_guard_signout'); ?></li>
            </ul>
          </li>
        </ul>
        
      </div>
    </div>
  </div>  
</div> 
