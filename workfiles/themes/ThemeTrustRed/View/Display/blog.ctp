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
  'sheet' => 'blog-header',
));
?>
<div id="entries" class="bk-block-content">
  <?php foreach ($entries as $entry) : ?>
    <?php
    echo $this->element('entry', array(
      'entry' => $entry,
    ));
    ?>
  <?php endforeach ; ?>
  <?php
  echo $this->element('Baked/paginator');
  ?>
</div>
<?php
echo $this->element('Baked/sheet', array(
  'sheet' => 'blog-footer',
));

