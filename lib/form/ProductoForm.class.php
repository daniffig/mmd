<?php

/**
 * Producto form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class ProductoForm extends BaseProductoForm
{
  public function configure()
  {
    $this->setWidget('categoria_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Categoria', 'peer_method' => 'doSelectActivos', 'add_empty' => false)));

    if ($this->getObject()->getId())
    {
      $this->setDefault('categoria_id', $this->getObject()->getTipoProducto()->getCategoriaId());
    }

    $tipo_id = new dcWidgetFormChosenChoice(array('choices' => array()));

    $this->setWidget('tipo_producto_id', new dcWidgetFormJQueryDependence(array(
      "widget" => $tipo_id,
      "observed_id" => "producto_categoria_id",
      "on_change" => array(get_class($this), "updateTipoProductoWidgetCriteria"),
      "no_value_text" => 'Seleccione una Categoría.'
    )));

    $this->setWidget('marca_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Marca', 'peer_method' => 'doSelectActivos', 'add_empty' => false)));

    $this->setWidget('imagen', new sfWidgetFormInputFileEditable(array('file_src' => $this->getObject()->getImagenThumb(), 'is_image' => true, 'delete_label' => 'Seleccione para eliminar la imagen actual.')));

    $this->setValidator('imagen', new sfValidatorFile(
          array (
            'required' => false,
            'max_size' => '2097152',
            'mime_types' => array ('image/jpeg', 'image/jpg', 'image/png', 'image/gif')),
          array ( 
            'invalid' => 'Archivo inválido.',
            'required' => 'Seleccione un archivo para subir.',
            'max_size' => 'El tamaño máximo es 2MB',
            'mime_types' => 'El archivo debe ser formato JPG, PNG o GIF.')
          )
        );

    $this->setWidget('es_activo', new sfWidgetFormInputHidden());

    $this->getWidgetSchema()->setHelp('imagen', "2MB máximo, archivos permitidos (jpeg, jpg, png, gif)");

    $this->setValidator('imagen_delete', new sfValidatorBoolean());

    // Validaciones
    $this->setValidator('tipo_producto_id', new sfValidatorPropelChoice(array('model' => 'TipoProducto'), array('required' => 'Requerido.', 'invalid' => 'Valor inválido.')));
    $this->setValidator('modelo', new sfValidatorString(array(), array('required' => 'Requerido.')));
    $this->setValidator('precio', new sfValidatorNumber(array('min' => '0.001'), array('required' => 'Requerido.', 'invalid' => 'Valor inválido.', 'min' => 'Debe especificar un valor mayor a cero.')));
    $this->setValidator('stock_minimo', new sfValidatorInteger(array('min' => '0'), array('required' => 'Requerido.', 'invalid' => 'Valor inválido.', 'min' => 'Debe especificar un valor mayor o igual a cero.')));
    

    $this->validatorSchema->setOption('allow_extra_fields', true);

    // Ayudas

    $this->getWidgetSchema()->setHelp('precio', 'Formato: 199.00');

    // Restricciones
    $this->getWidget('precio')->setAttribute('class', 'positive');
    $this->getWidget('stock_minimo')->setAttribute('class', 'positive-integer');

  public function getNewFieldsets()
  {
    return array('NONE' => array('categoria_id', 'tipo_producto_id', 'marca_id', 'modelo', 'precio', 'descripcion', 'stock_minimo', 'imagen', 'es_activo'));
  }

  public function getEditFieldsets()
  {
    return array('NONE' => array('categoria_id', 'tipo_producto_id', 'marca_id', 'modelo', 'precio', 'descripcion', 'stock_minimo', 'imagen', 'es_activo'));
  }

  public static function updateTipoProductoWidgetCriteria($widget, $values)
  {
    $criteria = new Criteria();
    $criteria->add(TipoProductoPeer::CATEGORIA_ID, $values['producto_categoria_id']);

    if ($choices = TipoProductoPeer::doSelectChoices($criteria))
    {
      $widget->getOption("widget")->setAttribute("hidden", false);
      $widget->getOption("widget")->setOption("choices", $choices);
    }
    else
    {
      $widget->getOption("widget")->setAttribute("hidden", true);
    }
  }
}
