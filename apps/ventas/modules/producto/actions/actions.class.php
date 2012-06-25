<?php

require_once dirname(__FILE__).'/../lib/productoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productoGeneratorHelper.class.php';

/**
 * producto actions.
 *
 * @package    mmd
 * @subpackage producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class productoActions extends autoProductoActions
{
  public function executeActivar()
  {
    $this->getRoute()->getObject()->activar();
    
    $this->getUser()->setFlash('notice', 'El Producto fue activado con éxito.');

    $this->redirect('@producto');
  }

  public function executeDesactivar()
  {
    $this->getRoute()->getObject()->desactivar();
    
    $this->getUser()->setFlash('notice', 'El Producto fue desactivado con éxito.');

    $this->redirect('@producto');
  }

  public function executeAgregarProductoVenta(sfWebRequest $request)
  {
    if ($this->getUser()->tieneVenta())
    {
      $this->redirect($this->generateUrl('producto_venta_agregar', array('producto_id' => $this->getRoute()->getObject()->getId())));
    }

    $this->getUser()->setFlash('error', 'Ud. no tiene ninguna Venta Activa.');

    $this->redirect('@producto');
  }

  // Métodos reimplementados

  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->hasGroup('Empleados'))
    {
      $this->getUser()->setAttribute('producto.filters', array('es_activo' => true), 'admin_module');
    }

    parent::executeIndex($request);
  }

 protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      if ($file = $this->form->getValue('imagen'))
      {
        $filename = md5($form->getObject()->getId());
        $extension = $file->getOriginalExtension();

        $save_path = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'productos' . DIRECTORY_SEPARATOR;

        // Tenemos que guardar la imagen en el servidor, sino el plugin no funciona.
        $file->save($save_path . $filename . $extension);

        // Creamos una nueva instancia de sfImage con la imagen que cargamos.
        $img = new sfImage($file->getSavedName(), $file->getType());

        // Como sólo queremos conservar las imágenes limitadas a una dimensión máxima de 640x480px, vamos a verificar si la imagen es más ancha o más alta, para realizar la transformación conservando la relación de aspecto.

        if ($img->getWidth() > 640 || $img->getHeight() > 480)
        {
          if ($img->getWidth() > $img->getHeight())
          {
            $height = (640 / $img->getWidth()) * $img->getHeight();
            $img->resize(640, $height);
          }
          else
          {
            $width = (480 / $img->getHeight()) * $img->getWidth();
            $img->resize($width, 480);
          }

          $img->save();
        }

        // Por último, en base a la imagen transformada, creamos un thumbnail para mostrar en los listados
        $img->thumbnail(80, 80);
        $img->saveAs($save_path . $filename . "_thumb" . $extension);
      }

      if($form->getValue('foto_delete'))
      {
        if (file_exists($form->getObject()->getFoto()))
        {
          unlink($form->getObject()->getFoto());
        }
      }

      $Producto = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Producto)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@producto_new');
      }
      else if ($request->hasParameter('_save_and_list'))
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@producto');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'producto_edit', 'sf_subject' => $Producto));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
