<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <?php if($sf_user->isAuthenticated()):?>
        <?php include_partial('menu/menu'); ?>
    <?php endif?>
 
    <div class="container" id="wrapper"><!--wrapper -->
	<?php echo $sf_content ?>
    </div><!--/wrapper -->

    <div id="footer">
    	<hr class="divider-footer"/>
     	<?php echo image_tag('dvorak_icon.png'); ?>
    </div>
	  <script type="text/javascript">
	    $(".numeric").numeric();
	    $(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
	    $(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
	    $(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	    $("#remove").click(
		    function(e)
		    {
			    e.preventDefault();
			    $(".numeric,.integer,.positive").removeNumeric();
		    }
	    );
	  </script>
  </body>
</html>
