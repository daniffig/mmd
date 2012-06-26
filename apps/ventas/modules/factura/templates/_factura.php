<?php use_stylesheet('factura.css'); ?>
<table id="HeaderFactura">
  <colgroup>
   	<col class="ladoIzqH"/>
    <col class="centroH"/>
    <col class="ladoDerH"/>
  </colgroup>
  <tr>
  	<td></td>
   	<td id="tipoFactura" align="center"><?php echo $factura->getTipoFactura(); ?></td>
		<td></td>
  </tr>
  <tr>
  	<td align="center"><img src="lightbulb_icon.jpg" /></td>
		<td></td>
		<td align="center">Nº <?php echo $factura->getNroFactura(); ?></td>
  </tr>
	<tr>
		<td align="center" class="datosEmpresa"><?php echo $sucursal->getDomicilio(); ?></td>
		<td></td>
		<td class="datosEmpresa" align="center">Cuit: <?php echo Preferencia::get('empresa_cuit'); ?></td>
	</tr>
	<tr>
		<td align="center" class="datosEmpresa">Télefono: <?php echo $sucursal->getTelefono(); ?></td>
		<td></td>
		<td align="center"><strong>Fecha: </strong><?php echo $venta->getCreatedAt(); ?></td>
	</tr>
  <tr>
    <td><br /></td>
  </tr>
  <tr>
	  <td><strong>Cliente: </strong><?php echo $venta->getCliente()->getApellidoYNombre(); ?></td>
  	<td></td>
		<td align="center"><strong>Cuit: o Dni: </strong><?php echo $cliente->getNroDocumento(); ?></td>
	</tr>
	<tr>
  	<td><strong>Domicilio: </strong><?php echo $cliente->getDireccion(); ?></td>
  </tr>
  <tr>
  	<td><?php echo $venta->getMedioPago(); ?></td>
  </tr>
	<tr>
  	<td><?php echo $factura->getSituacionImpositiva(); ?></td>
  </tr>       
</table>        
<table id="bodyFactura">
  <tr>
  	<th>cantidad</td>
		<th>Detalle</th>
		<th>precio U.</th>
		<th>importe</th>
	</tr>
  <?php foreach ($productos_venta as $producto_venta): ?>
  <tr>
    <td><?php echo $producto_venta->getCantidad(); ?></td>
    <td><?php echo $producto_venta->getProducto(); ?></td>
    <td><?php echo $producto_venta->getPrecioUnitarioFormateado(); ?></td>
    <td><?php echo $producto_venta->getPrecioTotalFormateado(); ?></td>
  </tr>
  <?php endforeach; ?>
	<?php /* <tr><!--SI ES FACTURA A-->
    <th>subtotal</th>
    <th>IVA % </th>
    <th>IVA $ </th>
  </tr>*/ ?>
  <tr>
	  <td></td>
		<td></td>
		<td><strong>Total</strong></td>
		<td><?php echo $venta->getTotalFormateado(); ?></td>
	</tr>
</table>

