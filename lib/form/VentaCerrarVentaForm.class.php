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

    $this->setWidget('cliente_id', new pmWidgetFormPropelChoiceOrCreate(array('model' => 'Cliente', 'url' => 
'cliente/new', 'new_label' => 'Agregar Cliente')));

    $this->setWidget('sucursal_id', new sfWidgetFormInputHidden());
    $this->setWidget('medio_pago_id', new dcWidgetFormPropelChosenChoice(array('model' => 'MedioPago')));

    $this->setWidget('es_finalizado', new sfWidgetFormInputHidden());
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());
  }
}
