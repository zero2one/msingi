<?php
/**
 * @file
 * Msingi theme implementation to display a block
 * 
 * Available variables:
 * - $attributes         : the block wrapper html attributes
 * - $title_attributes   : the block title html attributes
 * - $content_attributes : the block content html attributes
 * 
 * - $block              : the block
 * - $content            : the block content
 */
?>
<div<?php print $attributes; ?>><div class="block-inner clearfix">
  <?php print render($title_prefix); ?>
  
  <?php if ($block->subject): ?>
    <div<?php print $title_attributes; ?>>
      <h2><?php print $block->subject; ?></h2>
    </div>
  <?php endif; ?>
  
  <?php print render($title_suffix); ?>
  
  <div<?php print $content_attributes; ?>>
    <?php print $content ?>
  </div>
</div></div>
