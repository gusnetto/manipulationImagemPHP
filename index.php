<?php

// Constante
define('DIR_IMAGE', 'images/');

// Import classes
require_once('library/image.php');
require_once('library/cache.php');
require_once('library/convert.php');



$imagem = new Convert();

$img = $imagem->resize($_GET['image'],$_GET['width'], $_GET['height']);

?>

<img src="<?php echo $img;?>" />