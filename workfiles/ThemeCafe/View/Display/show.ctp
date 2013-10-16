<?php
$title = NULL;
if ($currentMenu['Page']['depth'] > 0 || $currentMenu['Page']['name'] != 'index') {
  $title = $currentMenu['Page']['title'];
}
$this->set('title', $title);
?>

<div id="sub">
  <?php
  echo $this->element('navigation');
  echo $this->element('Baked/sheet', array(
    'sheet' => 'sub',
  ));
  ?>
</div><!-- #sub -->

<div id="main">
  <?php
  echo $this->element('Baked/sheet', array(
    'sheet' => 'main',
  ));
  ?>
</div><!-- #main -->

