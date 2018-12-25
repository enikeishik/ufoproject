<?php
/**
 * @var \Ufo\Modules\View $this
 * @var array $items
 */

?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?=$title?></title>
</head>
<body>
<h1><?=$title?></h1>
<?php if(count($items) > 0): ?>
    <ul>
<?php foreach($items as $item): ?>
        <li><?=$item['title']?></li>
<?php endforeach; ?>
    </ul>
<?php endif; ?>
<?=$this->renderWidgets('left col top')?>
</body>
</html>
