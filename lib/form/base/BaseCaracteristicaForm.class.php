<?php

/**
 * Caracteristica form base class.
 *
 * @method Caracteristica getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCaracteristicaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'tipo_id'                      => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => false)),
      'nombre'                       => new sfWidgetFormInputText(),
      'caracteristica_producto_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Producto')),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'tipo_id'                      => new sfValidatorPropelChoice(array('model' => 'Tipo', 'column' => 'id')),
      'nombre'                       => new sfValidatorString(array('max_length' => 255)),
      'caracteristica_producto_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Producto', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Caracteristica', 'column' => array('nombre')))
    );

    $this->widgetSchema->setNameFormat('caracteristica[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Caracteristica';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['caracteristica_producto_list']))
    {
      $values = array();
      foreach ($this->object->getCaracteristicaProductos() as $obj)
      {
        $values[] = $obj->getProductoId();
      }

      $this->setDefault('caracteristica_producto_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCaracteristicaProductoList($con);
  }

  public function saveCaracteristicaProductoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['caracteristica_producto_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CaracteristicaProductoPeer::CARACTERISTICA_ID, $this->object->getPrimaryKey());
    CaracteristicaProductoPeer::doDelete($c, $con);

    $values = $this->getValue('caracteristica_producto_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CaracteristicaProducto();
        $obj->setCaracteristicaId($this->object->getPrimaryKey());
        $obj->setProductoId($value);
        $obj->save();
      }
    }
  }

}
