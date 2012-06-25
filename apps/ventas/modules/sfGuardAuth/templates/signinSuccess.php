<div style="margin:0px auto; width:285px">
<h3>Electrohogar s.a - Inicio Sesión</h3>
<br/>
<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input style="float:right" class="btn btn-success" type="submit" value="Iniciar sesión" />
</form>
</div>
