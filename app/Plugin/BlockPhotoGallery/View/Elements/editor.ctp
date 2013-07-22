<?php
$uploaderId = sprintf('photo-gallary-uploader-%s', $block['Block']['id']);
?>
<ul class="bk-editor-boxes">
  <li>
    <div class="bk-title"><?php echo __('Size') ?></div>
    <a href="javascript:;" data-bk-block-photo-gallery-increase><i class="icon-plus icon-2x"></i></a>
    <a href="javascript:;" data-bk-block-photo-gallery-decrease><i class="icon-minus icon-2x"></i></a>
  </li>
</ul>

<div class="spacer2"></div>

<?php
echo $this->Form->create('File', array(
  'default' => FALSE,
  'class' => 'bk-form-01 bk-photo-gallery-form',
));
?>
<ul class="block-photo-gallery-edit-list" id="bk-block-photo-gallery-edit-list-<?php echo $block['Block']['id'] ?>">
  <?php foreach (@$block['Block']['data']['photos'] as $photo) : ?>
    <?php
    $thumbUrl = sprintf('%sfiles/images/square/70/%s.%s', URL, $photo['file']['code'], $photo['file']['ext']);
    ?>
    <li style="background-image: url(<?php echo $thumbUrl ?>)" data-bk-file-id="<?php echo $photo['file_id'] ?>">
      <a href="javascript:;" class="bk-photo-gallery-delete-photo"><i class="icon-remove-sign icon-large"></i></a>
      <?php
      echo $this->Form->input("File.{$photo['file_id']}.title", array(
        'value' => $photo['title'],
      ));
      echo $this->Form->input("File.{$photo['file_id']}.alt", array(
        'value' => $photo['alt'],
      ));
      ?>
    </li>
  <?php endforeach ; ?>

  <script>
  $(function(){
    $('#bk-block-photo-gallery-edit-list-<?php echo $block['Block']['id'] ?>').sortable({
      axis: 'y',
      update: function(event, ui) {
        baked.blocks.blockPhotoGallery.saveSort(<?php echo $block['Block']['id'] ?>);
      }
    });
  });
  </script>
</ul>
<div class="spacer2"></div>
<button type="submit"><?php echo __('Save') ?></button>
<?php
echo $this->Form->end();
?>
<div class="spacer2"></div>

<div id="<?php echo $uploaderId ?>">
  <p>Your browser doesn't have Flash, Silverlight, Gears, BrowserPlus or HTML5 support.</p>
</div>

<script>
$(function(){
  (function(){
    if (baked.blocks.blockPhotoGallery.instances['<?php echo $uploaderId ?>']) return;
    baked.blocks.blockPhotoGallery.instances['<?php echo $uploaderId ?>'] =
    $('#<?php echo $uploaderId ?>').plupload({
      // General settings
      runtimes : 'html5,flash,browserplus,silverlight,gears,html4',
      url : '<?php echo URL ?>block_photo_gallery/block_photo_gallery_api/upload',
      max_file_size : '1000mb',
      max_file_count: 20, // user can add no more then 20 files at a time
      //chunk_size : '1mb',
      rename: true,
      multiple_queues : true,

      // Resize images on clientside if we can
      //resize : {width : 320, height : 240, quality : 90},

      // Rename files by clicking on their titles
      rename: true,

      // Sort files
      sortable: true,

      // Specify what files to browse for
      filters : [
        {title : "Image files", extensions : "jpg,gif,png"}
        //{title : "Zip files", extensions : "zip,avi"}
      ],

      // Flash settings
      flash_swf_url : '<?php echo URL ?>js/plupload/plupload.flash.swf',

      // Silverlight settings
      silverlight_xap_url : '<?php echo URL ?>js/plupload/plupload.silverlight.xap',

      init: {
        UploadComplete: function(up, files) {
          baked.blocks.blockPhotoGallery.reload(<?php echo $block['Block']['id'] ?>);
        }
      },

      multipart_params : {
        token : baked.token,
        'block_id': <?php echo $block['Block']['id'] ?>
      }
    });
  })();
});
</script>
