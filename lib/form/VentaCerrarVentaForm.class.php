<?php

/**
 * Venta form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class VentaCerrarVentaForm extends BaseVentaForm
{
  public function configure()
  {
    $usuario = sfContext::getInstance()->getUser()->getGuardUser();

    $this->setWidget('created_at', new sfWidgetFormInputHidden());
    $this->setWidget('created_by', new sfWidgetFormInputHidden());
    $this->setWidget('updated_at', new sfWidgetFormInputHidden());
    $this->setWidget('updated_by', new sfWidgetFormInputHidden());

    if ($this->getObject()->isNew())
    {
      $this->setDefault('created_by', $usuario->getId());
      $this->setDefault('sucursal_id', $usuario->getProfile()->getSucursalId());
    }
    else
    {
      $this->setDefault('updated_by', sfContext::getInstance()->getUser()->getGuardUser()->getId());
    }

    $this->setWidget('cliente_id', new pmWidgetFormPropelChoiceOrCreate(array('model' => 'Cliente', 'peer_method' => 'doSelectActivos', 'url' => 
'cliente/new', 'new_label' => 'Agregar Cliente')));

    $this->setWidget('sucursal_id', new sfWidgetFormInputHidden());

    $this->setWidget('medio_pago_id', new dcWidgetFormPropelChosenChoice(array('model' => 'MedioPago', 'peer_method' => 'doSelectActivos')));

    $this->setWidget('es_finalizado', new sfWidgetFormInputHidden());
    $this->setDefault('es_finalizado', true);

    $this->setWidget('es_activo', new sfWidgetFormInputHidden());

    /*// Formulario de la Factura
    $factura = new Factura();
    $factura->setVentaId($this->getObject()->getId());

//    throw new Exception ();

    //$factura->setVenta($this->getObject());
    $factura_form = new FacturaForm($factura);

    //$factura_form->getWidget('venta_id')setValue('venta_id', $this->getObject()->getId());

    //$factura->setWidget('venta_id', new sfWidgetFormInputHidden());
    
    $this->embedForm('factura', $factura_form);

    $this->getEmbeddedForm('factura')->setDefault('venta_id', $this->getObject()->getId());

    // Validaciones
   // $this->setValidator('factura', new sfValidatorPass());*/

    $this->validatorSchema->setOption('allow_extra_fields', true);
  }  

  public function getNewActions()
  {
    return array('_save' => NULL);
  }

  public function getEditActions()
  {
    return $this->getNewActions();
  }
}
