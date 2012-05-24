<?php

/**
 * Caracteristica filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCaracteristicaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipo_id'                      => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
      'nombre'                       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'caracteristica_producto_list' => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tipo_id'                      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Tipo', 'column' => 'id')),
      'nombre'                       => new sfValidatorPass(array('required' => false)),
      'caracteristica_producto_list' => new sfValidatorPropelChoice(array('model' => 'Producto', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('caracteristica_filters[%s]');

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

    $criteria->addJoin(CaracteristicaProductoPeer::CARACTERISTICA_ID, CaracteristicaPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CaracteristicaProductoPeer::PRODUCTO_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CaracteristicaProductoPeer::PRODUCTO_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Caracteristica';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'tipo_id'                      => 'ForeignKey',
      'nombre'                       => 'Text',
      'caracteristica_producto_list' => 'ManyKey',
    );
  }
}
