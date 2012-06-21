<?php use_helper('Text') ?>

<div id="informacion-basica">
	<h1><?php echo $producto->getTipoProducto()." ".$producto->getMarca()." ".$producto->getModelo();?></h1>
	<br/>
        <h2><?php echo $producto->getPrecio().' $'; ?> </h2>
	<br/>
        <h2 id="caja-stock" style="<?php echo ($producto->getStock() < 20) ? '#F00' : '#00a200' ?>">Stock: <?php echo $producto->getStock()?></h2>
</div>

<div id="imagen">
	<?php //echo get_slot() ?>
</div>        
<div style="clear:both"></div>  
<div>
	<h4>Descripci&ograve;n</h4>
        <p><?php echo $producto->getDescripcion(); ?></p>
</div>

