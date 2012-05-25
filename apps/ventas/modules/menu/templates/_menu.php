<div class="navbar navbar-fixed-top">
  
  <div class="navbar-inner">
    <div class="container" style="width: auto;">
      
      <div class="nav-collapse">
        
        <?php  echo link_to(__('MMD'), '@producto', array('class' => 'brand')); ?>
        
        <ul class="nav">
         
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tablas de referencia<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li class="nav-header">Tipos de Productos</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Listado"), '@tipo'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Nueva"), '@tipo_new'); ?></li>
              <li class="divider"></li>
              <li class="nav-header">Marcas de Productos</li>
              <li><?php  echo link_to(__("<i class='icon-th-list'></i> Listado"), '@marca'); ?></li>
              <li><?php  echo link_to(__("<i class='icon-plus-sign'></i> Nueva"), '@marca_new'); ?></li>
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
