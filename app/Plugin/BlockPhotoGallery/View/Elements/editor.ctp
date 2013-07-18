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

<?php if (!empty($block['Block']['data']['photos'])) : ?>
  <?php
  echo $this->Form->create('File', array('type' => 'defailt'));
  ?>
  <ul class="block-photo-gallery-edit-list">
    <?php foreach ($block['Block']['data']['photos'] as $photo) : ?>
      <?php
      $thumbUrl = sprintf('%sfiles/images/square/60/%s.%s', URL, $photo['file']['code'], $photo['file']['ext']);
      ?>
      <li style="background-image: url(<?php echo $thumbUrl ?>)">
        <?php
        echo $this->Form->input("File.{$photo['file_id']}.title");
        echo $this->Form->input("File.{$photo['file_id']}.alt");
        ?>
      </li>
    <?php endforeach ; ?>
  </ul>
  <div class="spacer2"></div>
  <button type="submit"><?php echo __('Save') ?></button>
  <?php
  echo $this->Form->end();
  ?>
  <div class="spacer2"></div>
<?php endif ; ?>

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
      url : '<?php echo URL ?>block_photo_gallery/api/upload',
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
          c(files);
        },
        FileUploaded: function(up, file, info) {
          c(info);
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
