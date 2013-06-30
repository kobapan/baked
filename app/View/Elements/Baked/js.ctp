<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="<?php echo URL ?>js/class/Baked.js"></script>
<script src="<?php echo URL ?>js/interface/baked.interface.js"></script>
<?php if (EDITTING) : ?>
  <script src="<?php echo URL ?>js/interface/baked.editting.interface.js"></script>
<?php endif ; ?>
<script>
  baked.base = '<?php echo URL ?>';
  baked.token = '<?php echo $_token; ?>';
  baked.pageId = '<?php echo $currentMenu['Page']['id'] ?>';
</script>
<?php foreach ($blockEquipments['js'] as $js) : ?>
  <?php if (!EDITTING && $js['editting']) continue ; ?>
  <script src="<?php echo URL.$js['file'] ?>"></script>
<?php endforeach ; ?>
