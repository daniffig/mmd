<?php

/**
 * Producto form base class.
 *
 * @method Producto getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'marca_id'                     => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => false)),
      'modelo'                       => new sfWidgetFormInputText(),
      'precio'                       => new sfWidgetFormInputText(),
      'descripcion'                  => new sfWidgetFormInputText(),
      'caracteristica_producto_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Caracteristica')),
      'tipo_producto_list'           => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Tipo')),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'marca_id'                     => new sfValidatorPropelChoice(array('model' => 'Tipo', 'column' => 'id')),
      'modelo'                       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'precio'                       => new sfValidatorNumber(),
      'descripcion'                  => new sfValidatorPass(array('required' => false)),
      'caracteristica_producto_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Caracteristica', 'required' => false)),
      'tipo_producto_list'           => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Tipo', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Producto', 'column' => array('modelo')))
    );

    $this->widgetSchema->setNameFormat('producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producto';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['caracteristica_producto_list']))
    {
      $values = array();
      foreach ($this->object->getCaracteristicaProductos() as $obj)
      {
        $values[] = $obj->getCaracteristicaId();
      }

      $this->setDefault('caracteristica_producto_list', $values);
    }

    if (isset($this->widgetSchema['tipo_producto_list']))
    {
      $values = array();
      foreach ($this->object->getTipoProductos() as $obj)
      {
        $values[] = $obj->getTipoId();
      }

      $this->setDefault('tipo_producto_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCaracteristicaProductoList($con);
    $this->saveTipoProductoList($con);
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
    $c->add(CaracteristicaProductoPeer::PRODUCTO_ID, $this->object->getPrimaryKey());
    CaracteristicaProductoPeer::doDelete($c, $con);

    $values = $this->getValue('caracteristica_producto_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CaracteristicaProducto();
        $obj->setProductoId($this->object->getPrimaryKey());
        $obj->setCaracteristicaId($value);
        $obj->save();
      }
    }
  }

  public function saveTipoProductoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tipo_producto_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(TipoproductoPeer::PRODUCTO_ID, $this->object->getPrimaryKey());
    TipoproductoPeer::doDelete($c, $con);

    $values = $this->getValue('tipo_producto_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new TipoProducto();
        $obj->setProductoId($this->object->getPrimaryKey());
        $obj->setTipoId($value);
        $obj->save();
      }
    }
  }

}
