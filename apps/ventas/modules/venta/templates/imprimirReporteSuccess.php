<?php use_stylesheet('reporteVentas.css') ?>
<div id="container">
  <div id="header">
    <h1 style="color:green; float:left; font-size:25px; font-family:sans-serif,Loma">ElectroHogar s.a.</h1>
    <?php echo image_tag('electrohogar_banner.png'); ?>
    <p style="float:right">Fecha: <?php echo date('d/m/Y', time()); ?></p>
    <hr style="clear:both" />

    <h3>Reporte de ventas entre <?php echo $fecha_inicial; ?> y <?php echo $fecha_final; ?></h3>
   <br/>
   <?php foreach($Ventas as $Venta): ?>
    <table class="datosVenta">
      <tr>
        <td style="font-size:14px"><?php echo $Venta->getCreatedAt(); ?></td>
        <td style="font-size:14px"><?php echo $Venta->getCreatedBy(); ?></td>
        <td style="font-size:14px"><?php echo $Venta->getCliente(); ?></td>
        <td style="font-size:14px"><?php echo $Venta->getMedioPago(); ?></td>
        <td style="font-size:14px">Total: <?php echo $Venta->getTotalFormateado(); ?></td>
      </tr>
    </table>
    <?php $ProductosVenta = $Venta->getProductoVentas(); ?>
    <p style="font-size:13px" >&nbsp;&nbsp;Productos vendidos:</p>
    <table style="margin-left:30px">
      <tr>
        <th style="font-size:12px; padding:2px 10px; background-color:#e7eef6">Producto</th>
        <th style="font-size:12px; padding:2px 10px">Cantidad</th>
        <th style="font-size:12px; padding:2px 10px">Precio unitario</th>
        <th style="font-size:12px; padding:2px 10px">Importe</th>
      </tr>
      <?php foreach($ProductosVenta as $ProductoVenta): ?>
      <tr>
        <td style="font-size:12px"><?php echo $ProductoVenta->getProducto(); ?></td>
        <td align=center style="font-size:12px"><?php echo $ProductoVenta->getCantidad(); ?></td>
        <td align=center style="font-size:12px"><?php echo $ProductoVenta->getPrecioUnitarioFormateado(); ?></td>
        <td align=center style="font-size:12px"><?php echo $ProductoVenta->getPrecioTotalFormateado(); ?></td>
      </tr>
      <?php endforeach; ?>

    </table>
    <hr/>
    <?php endforeach; ?>
  </div>
</div> 
