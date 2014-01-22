<?php
// トップページ以外の場合に、ページタイトルをセット
$title = NULL;
if ($currentMenu['Page']['depth'] > 0 || $currentMenu['Page']['name'] != 'index') {
  $title = $currentMenu['Page']['title'];
}
$this->set('title', $title);
?>

<?php
echo $this->element('Baked/sheet', array(
  'sheet' => 'main',
));
?>
