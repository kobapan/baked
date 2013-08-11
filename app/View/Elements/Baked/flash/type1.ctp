<?php
$mes = Baked::getFlash();
?>
<?php if ($mes) : ?>
  <div class="flash-message <?php echo $mes['type'] ?>"><?php echo $mes['message'] ?></div>
  <div class="spacer2"></div>
<?php endif ; ?>

