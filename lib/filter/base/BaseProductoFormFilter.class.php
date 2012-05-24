<?php

/**
 * Producto filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProductoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'marca_id'                     => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
      'modelo'                       => new sfWidgetFormFilterInput(),
      'precio'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'                  => new sfWidgetFormFilterInput(),
      'caracteristica_producto_list' => new sfWidgetFormPropelChoice(array('model' => 'Caracteristica', 'add_empty' => true)),
      'tipo_producto_list'           => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'marca_id'                     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Tipo', 'column' => 'id')),
      'modelo'                       => new sfValidatorPass(array('required' => false)),
      'precio'                       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'descripcion'                  => new sfValidatorPass(array('required' => false)),
      'caracteristica_producto_list' => new sfValidatorPropelChoice(array('model' => 'Caracteristica', 'required' => false)),
      'tipo_producto_list'           => new sfValidatorPropelChoice(array('model' => 'Tipo', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addCaracteristicaProductoListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(CaracteristicaProductoPeer::PRODUCTO_ID, ProductoPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CaracteristicaProductoPeer::CARACTERISTICA_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CaracteristicaProductoPeer::CARACTERISTICA_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addTipoProductoListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(TipoproductoPeer::PRODUCTO_ID, ProductoPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(TipoproductoPeer::TIPO_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(TipoproductoPeer::TIPO_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Producto';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'marca_id'                     => 'ForeignKey',
      'modelo'                       => 'Text',
      'precio'                       => 'Number',
      'descripcion'                  => 'Text',
      'caracteristica_producto_list' => 'ManyKey',
      'tipo_producto_list'           => 'ManyKey',
    );
  }
}
