<div class="box">
  <header>
    <h1>インストール済みブロック</h1>
  </header>
  <div class="inner">
    <?php
    ?>
    <table>
      <thead>
        <tr>
          <th></th>
          <th><?php echo __('ブロック名') ?></th>
          <th><?php echo __('作者') ?></th>
          <th><?php echo __('URL') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($blockPackages as $p => $blockPackage) : ?>
          <tr>
            <td><input type="checkbox" name="data[BlockPackage][package]" value="<?php echo h($p) ?>"></td>
            <td class="name"><i class="icon <?php echo $blockPackage['icon'] ?>"></i><?php echo h($blockPackage['name']) ?></td>
            <td><?php echo h(@$blockPackage['author']) ?></td>
            <td><?php echo h(@$blockPackage['url']) ?></td>
          </tr>
        <?php endforeach ; ?>
      </tbody>
    </table>
  </div>
</div>
