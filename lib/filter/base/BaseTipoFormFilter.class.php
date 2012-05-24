<?php

/**
 * Tipo filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTipoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo_padre_id'      => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
      'tipo_producto_list' => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'             => new sfValidatorPass(array('required' => false)),
      'tipo_padre_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Tipo', 'column' => 'id')),
      'tipo_producto_list' => new sfValidatorPropelChoice(array('model' => 'Producto', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(TipoproductoPeer::TIPO_ID, TipoPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(TipoproductoPeer::PRODUCTO_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(TipoproductoPeer::PRODUCTO_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Tipo';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'nombre'             => 'Text',
      'tipo_padre_id'      => 'ForeignKey',
      'tipo_producto_list' => 'ManyKey',
    );
  }
}
