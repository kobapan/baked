<?php
$class = "photo-gallery-{$block['Block']['id']}";
?>
<ul class="block-photo-gallery">

  <?php if (empty($block['Block']['data']['photos'])) : ?>
    <div class="bk-note-01"><?php echo __('Please upload photos.') ?></div>
  <?php endif ; ?>


  <?php foreach (@$block['Block']['data']['photos'] as $photo) : ?>
    <?php
    $originalUrl = sprintf('%sfiles/images/width/600/%s.%s', URL, $photo['file']['code'], $photo['file']['ext']);
    $thumbUrl = sprintf('%sfiles/images/square/%d/%s.%s', URL, $block['Block']['data']['width'], $photo['file']['code'], $photo['file']['ext']);
    $title = !empty($photo['title']) ? $photo['title'] : '';
    $alt = !empty($photo['alt']) ? $photo['alt'] : '';
    ?>
    <li><a class="<?php echo $class ?>" href="<?php echo $originalUrl ?>" title="<?php echo $title ?>"><img src="<?php echo $thumbUrl ?>" alt="<?php echo $alt ?>"></a></li>
  <?php endforeach ; ?>

  <script>
  $(function(){
    $('a.<?php echo $class ?>').colorbox({rel:'<?php echo $class ?>'});
  });
  </script>
</ul>

