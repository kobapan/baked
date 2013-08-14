<?php echo __('You received an inquiry.') ?>


--

IP: <?php echo $_SERVER["REMOTE_ADDR"]; ?>


<?php foreach ($items as $item) : ?>
◆<?php echo $item['item']['name'] ?>

<?php
$value = is_array($item['value']) ? implode(', ', $item['value']) : $item['value'] ;
echo $value;
?>


<?php endforeach ; ?>
--

