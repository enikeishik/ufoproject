<?php
/**
 * @var array $widgets
 */
?>

<div class="widgets">
<?php foreach($widgets as $widget): ?>
<?=$this->renderWidget($widget)?>
<?php endforeach; ?>
</div>
