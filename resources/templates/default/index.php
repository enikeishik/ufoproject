<?php
/**
 * @var \Ufo\Modules\View $this
 * @var array $items
 */

?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?=$section->title?></title>
<link rel="stylesheet" type="text/css" href="/styles.css">
</head>
<body>
<div id="wrapper">
<div id="header">
</div>
<div id="container">
    <div id="middle"><div id="content"><div id="contentinner">
        <?=$this->renderWidgets('middle col top')?>
        <h1><?=$section->title?></h1>
        <?=($content??'')?>
        <?=$this->renderWidgets('middle col bottom')?>
    </div></div></div>
    <div id="left"><div id="leftinner">
        <?=$this->renderWidgets('left col top')?>
        <?=$this->renderWidgets('left col bottom')?>
    </div></div>
    <div id="right"><div id="rightinner">
        <?=$this->renderWidgets('right col top')?>
        <?=$this->renderWidgets('right col bottom')?>
    </div></div>
</div>
<div id="footer">
    Copyright &copy; 2018-2019
</div>
</div>
</body>
</html>
