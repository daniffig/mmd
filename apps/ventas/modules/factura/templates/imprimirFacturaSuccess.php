<?php use_helper('I18N', 'Date') ?>
<?php include_partial('factura/assets') ?>
<?php include_partial('factura/factura', array('factura' => $Factura, 'venta' => $Venta, 'productos_venta' => $ProductoVentas, 'cliente' => $Cliente, 'sucursal' => $Sucursal)) ?>

